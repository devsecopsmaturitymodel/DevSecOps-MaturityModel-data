<?php

require_once "functions.php";

$errorMsg = array();
$implementationReferenceFile = "src/assets/YAML/default/implementations.yaml";
$metadata = readYaml("src/assets/YAML/meta.yaml");

$teams = $metadata["teams"];
if (sizeof($teams) == 0) {
    echo "Warning: No teams defined";
}
$teamsImplemented = array();
foreach ($teams as $team) {
    $teamsImplemented[$team] = false;
}

$files = glob("src/assets/YAML/default/*/*.yaml");
$dimensions = array();
foreach ($files as $filename) {
    echo "Reading $filename\n";
    if (preg_match("/_meta.yaml/", $filename)) continue;
    $dimension = getDimensions($filename);
    if (array_key_exists("_yaml_references", $dimension)) {
        unset($dimension['_yaml_references']);
    }
    $dimensions = array_merge_recursive($dimensions, $dimension);
}

$files = glob("src/assets/YAML/custom/*/*.yaml");
$dimensionsCustom = array();
$dimensionsAggregated = array();
foreach ($files as $filename) {
    echo "Reading custom $filename\n";
    $dimensionCustom = getDimensions($filename);
    $dimensionsCustom = array_merge_recursive_ex($dimensionsCustom, $dimensionCustom);
}

if (sizeof($files) > 0) {
    $dimensions = array_merge_recursive_ex($dimensions, $dimensionsCustom);
    foreach (getActions($dimensions) as list($dimension, $subdimension, $activities)) {
        if (!array_key_exists($dimension, $dimensionsAggregated)) $dimensionsAggregated[$dimension] = array();
        if (!array_key_exists($subdimension, $dimensionsAggregated[$dimension])) $dimensionsAggregated[$dimension][$subdimension] = array();
        foreach ($activities as $activityName => $activity) {
            if (isActivityExisting($dimensionsCustom, $activityName)) {
                $dimensionsAggregated[$dimension][$subdimension][$activityName] = $activity;
            }
        }
    }
} else {
    $dimensionsAggregated = $dimensions;
}

foreach ($dimensionsAggregated as $dimension => $subdimensions) {
    ksort($subdimensions);
    foreach ($subdimensions as $subdimension => $elements) {
        if (sizeof($elements) == 0) {
            echo "unsetting $subdimension\n";
            unset($dimensionsAggregated[$dimension][$subdimension]);
            continue;
        }
        if (substr($subdimension, 0, 1) == "_") {
            continue;
        }

        foreach ($elements as $activityName => $activity) {
            if (!array_key_exists("level", $activity)) {
                array_push($errorMsg,"Missing 'level' attribute in activity: $activityName");
	        }
	    
            echo "$subdimension | $activityName\n";
            if (!array_key_exists("uuid", $activity)) {
                array_push($errorMsg, "$activityName is missing an uuid in $dimension");
            } else {
                $uuid = $dimensionsAggregated[$dimension][$subdimension][$activityName]["uuid"];
                $tmp_activityName = getActivityNameByUuid($uuid, $dimensionsAggregated);
                if ($tmp_activityName != $activityName) {
                    array_push($errorMsg, "Duplicate UUID: $uuid in '$dimension'\n - ". $tmp_activityName ."\n - " . $activityName);
                }

                if ($uuid != getUuidByActivityName($activityName, $dimensionsAggregated)) {
                    array_push($errorMsg, "Duplicate activity name: ". $activityName ."");
                }
            }


            if (!array_key_exists("tags", $activity)) {
                $dimensionsAggregated[$dimension][$subdimension][$activityName]["tags"] = ["none"];
            }
            if (!array_key_exists("teamsImplemented", $activity)) {
                $dimensionsAggregated[$dimension][$subdimension][$activityName]["teamsImplemented"] = array();
            }
            $evidenceImplemented = array();
            if (array_key_exists("teamsEvidence", $activity) && is_array($activity["teamsEvidence"]) && IS_IMPLEMENTED_WHEN_EVIDENCE) {
                foreach ($activity["teamsEvidence"] as $team => $evidenceForTeam) {
                    if(!is_string($activity["teamsEvidence"][$team])) {
                        echo "teamsEvidence for team $team in $activityName is not a string, ignoring";
                        continue;
                    }
                    if (strlen($activity["teamsEvidence"][$team]) > 0) {
                        $evidenceImplemented[$team] = true;
                    } else {
                        echo "Warning: '$activityName -> evidence -> $team' has no evidence set but should have";
                    }
                }
            }
            $dimensionsAggregated[$dimension][$subdimension][$activityName]["teamsImplemented"] =
                array_merge(
                    $teamsImplemented,
                    $dimensionsAggregated[$dimension][$subdimension][$activityName]["teamsImplemented"],
                    $evidenceImplemented
                );
            if (!array_key_exists("openCRE", $activity["references"])) {
                $dimensionsAggregated[$dimension][$subdimension][$activityName]["references"]["openCRE"] = array();
                $dimensionsAggregated[$dimension][$subdimension][$activityName]["references"]["openCRE"][] = "https://www.opencre.org/rest/v1/standard/DevSecOps+Maturity+Model+(DSOMM)/" . $subdimension . "/" . $dimensionsAggregated[$dimension][$subdimension][$activityName]["uuid"];
            }
            // can be removed in 2025
            if (array_key_exists("isImplemented", $activity)) {
                unset($dimensionsAggregated[$dimension][$subdimension][$activityName]["isImplemented"]);
            }
            if (array_key_exists("evidence", $activity)) {
                unset($dimensionsAggregated[$dimension][$subdimension][$activityName]["evidence"]);
            }
            if (array_key_exists("dependsOn", $activity)) {
                foreach($activity['dependsOn'] as $index => $dependsOn) {
                    if(!is_string($dependsOn)) {
                        array_push($errorMsg, "The 'dependsOn' is not a string '" . json_encode($dependsOn) . "' (in $activityName)");
                        continue;
                    } 

                    // Swap uuids with activity name
                    $uuidRegExp = "/(uuid:)?\s*([0-9a-f]{6,}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{6,})/";
                    if (preg_match($uuidRegExp, $dependsOn, $matches)) {
                        $dependsOnUuid = $matches[2];
                        $dependsOn = getActivityNameByUuid($dependsOnUuid, $dimensionsAggregated);
                        if (is_null($dependsOn)) {
                            array_push($errorMsg,"DependsOn non-existing activity uuid: $dependsOnUuid  (in activity: $activityName)");
                        } else if ($matches[1] == "") {
                            echo "WARNING: DependsOn is not prefixed by 'uuid:' for $dependsOnUuid (in activity: $activityName)\n";
                        } 
                        
                        // echo "exchanged $dependsOnUuid with name $dependsOnActivityName\n";
                        $dimensionsAggregated[$dimension][$subdimension][$activityName]["dependsOn"][$index] = $dependsOn;
                        
                    } else {
                        if (is_null(getUuidByActivityName($dependsOn, $dimensionsAggregated))) {
                            array_push($errorMsg,"DependsOn non-existing activity: '$dependsOn' (in activity: $activityName)");
                        }
                    }
                }
            }
        }
    }
}


foreach ($dimensionsAggregated as $dimension => $subdimensions) {
    if (sizeof($subdimensions) == 0) {
        echo "unsetting $dimension\n";
        unset($dimensionsAggregated[$dimension]);
    }
}


$implementationReferences = readYaml($implementationReferenceFile)['implementations'];
assert_unique_refs($implementationReferences, $errorMsg);

resolve_json_ref($dimensionsAggregated);


if (count($errorMsg) > 0) {
    echo "\n\nFound " . count($errorMsg) . " errors:\n";
    foreach ($errorMsg as $e) {
        echo "ERROR: $e\n";
    }
    exit("Please fix the errors");
}




$dimensionsString = yaml_emit($dimensionsAggregated);
$targetGeneratedFile = getcwd() . "/src/assets/YAML/generated/generated.yaml";
echo "\nStoring to $targetGeneratedFile\n";
file_put_contents($targetGeneratedFile, $dimensionsString);



function assert_unique_refs($implementationReferences, &$errorMsg) {
    assert_unique_ref_by_key($implementationReferences, 'uuid', $errorMsg);
    assert_unique_ref_by_key($implementationReferences, 'name', $errorMsg);
    assert_unique_ref_by_key($implementationReferences, 'url', $errorMsg);
}

function assert_unique_ref_by_key($implementationReferences, $keyToAssert, &$errorMsg) {
    $all_values = array();

    foreach ($implementationReferences as $key => $reference) {
        if (array_key_exists($keyToAssert, $reference)) {
            $value = $reference[$keyToAssert];
            // echo "$key: $value\n";
            if (array_key_exists($value, $all_values)) {
                array_push($errorMsg, "Duplicate '$keyToAssert' in reference: " . $all_values[$value] . " and $key: '$value'");
            } else {
                $all_values[$value] = $key;
            }
        }
    }
}


/**
 *
 * @param unknown $dimensions
 * @param unknown $activityName
 * @return unknown
 */
function isActivityExisting($dimensions, $activityName)
{
    foreach (getActions($dimensions) as list($dimension, $subdimension, $activities)) {
        foreach ($activities as $activity => $activityContent) {
            if ($activity == $activityName) {
                return true;
            }
        }
    }
    return false;
}


/**
 *
 * @param array $array1
 * @param array $array2
 * @return unknown
 */
function array_merge_recursive_ex(array $array1, array $array2)
{
    $merged = $array1;

    foreach ($array2 as $key => & $value) {
        if (is_array($value) && isset($merged[$key]) && is_array($merged[$key])) {
            $merged[$key] = array_merge_recursive_ex($merged[$key], $value);
        } else if (is_numeric($key)) {
            if (!in_array($value, $merged)) {
                $merged[] = $value;
            }
        } else {
            $merged[$key] = $value;
        }
    }

    return $merged;
}


/**
 * Traverse in-place an array and replaces json-pointers.
 *
 * @param unknown $data (reference)
 */
function resolve_json_ref(&$data)
{


    /**
     *
     * @param unknown $value (reference)
     * @param unknown $key
     * @param unknown $ctx
     */
    function resolve_json_ref_cb(&$value, $key, $ctx)
    {
        if (!is_array($value)) {
            return;
        }

        if (!array_key_exists('$ref', $value)) {
            $ctx["ctx"] = &$value;
            array_walk($value, "resolve_json_ref_cb", $ctx);
            return;
        }

        // echo "key: $key\nvalue: ".var_dump($ctx). "\n";
        $ctx["ctx"][$key] = readYaml($value['$ref']);

    }


    // Create a context variable to store
    // the reference to the actual data, so that
    // resolve_reference can replace them.
    $ctx = array("ctx" => null);
    array_walk($data, "resolve_json_ref_cb", $ctx);
}
