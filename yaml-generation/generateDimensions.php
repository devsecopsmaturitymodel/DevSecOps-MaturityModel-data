<?php

require_once "functions.php";

$errorMsg = array();
$implementationReferenceFile = "src/assets/YAML/default/implementations.yaml";

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
$dimensions = sortActivitiesByLevel($dimensions);

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

$dependencies = array();
$activityIndex = array();
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
                array_push($errorMsg,"Missing 'level' attribute in activity: '$activityName'");
	        }
	    
            // echo "$subdimension | $activityName\n";
            if (!array_key_exists("uuid", $activity)) {
                array_push($errorMsg, "'$activityName' is missing an uuid in '$dimension'");
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
            if (array_key_exists("isImplemented", $activity)) {
                unset($dimensionsAggregated[$dimension][$subdimension][$activityName]["isImplemented"]);
            }
            if (array_key_exists("evidence", $activity)) {
                unset($dimensionsAggregated[$dimension][$subdimension][$activityName]["evidence"]);
            }
            if (array_key_exists("dependsOn", $activity)) {
                foreach($activity['dependsOn'] as $index => $dependsOnName) {
                    if(!is_string($dependsOnName)) {
                        array_push($errorMsg, "The 'dependsOn' is not a string '" . json_encode($dependsOnName) . "' (in $activityName)");
                        continue;
                    } 

                    // Load dependsOnName and dependsOnUuid, depending on actual content
                    $uuidRegExp = "/(uuid:)?\s*([0-9a-f]{6,}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{6,})/";
                    if (preg_match($uuidRegExp, $dependsOnName, $matches)) {
                        $dependsOnUuid = $matches[2];
                        $dependsOnName = getActivityNameByUuid($dependsOnUuid, $dimensionsAggregated);
                        if (is_null($dependsOnName)) {
                            array_push($errorMsg,"DependsOn non-existing activity uuid: $dependsOnUuid  (in activity: '$activityName')");
                        } else if ($matches[1] != "") {
                            echo "WARNING: DependsOn is prefixed by deprecated 'uuid:' for $dependsOnUuid (in activity: '$activityName'). Use activity name, or the uuid only\n";
                        }                         
                    } else {
                        $dependsOnUuid = getUuidByActivityName($dependsOnName, $dimensionsAggregated);
                        if (is_null(getUuidByActivityName($dependsOnName, $dimensionsAggregated))) {
                            array_push($errorMsg,"DependsOn non-existing activity: '$dependsOnName' (in activity: $activityName)");
                        }
                    }
                    // Trick emit_yaml() to have uuid plus a comment in a string. Removed in post-processing below.
                    $dimensionsAggregated[$dimension][$subdimension][$activityName]["dependsOn"][$index] = "{!$dependsOnUuid!}";
                    

                    // Build dependency graph
                    if (!array_key_exists($activityName, $activityIndex)) {
                        $activityIndex[$activityName] = count($activityIndex);
                    }
                    if (!array_key_exists($dependsOnName, $activityIndex)) {
                        $activityIndex[$dependsOnName] = count($activityIndex);
                    }
                    array_push_item_to($dependencies, $activityIndex[$dependsOnName], $activityIndex[$activityName]);

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

// Identify any issues regarding the references
$implementationReferences = readYaml($implementationReferenceFile)['implementations'];
$references = array("implementations" => $implementationReferences);
assertUniqueRefs($references, $errorMsg);
assertSecureUrlsInRefs($references, $errorMsg);
assertLiveUrlsInRefs($references, $errorMsg);

resolveYamlReferences($dimensionsAggregated, $references, $errorMsg);


// Inform of any errors detected
if (count($errorMsg) > 0) {
    echo "\n\nFound " . count($errorMsg) . " errors:\n";
    foreach ($errorMsg as $e) {
        echo "ERROR: $e\n";
    }
    exit("Please fix the errors");
}


// Post-process to add activity name as comment for `dependsOn`
$dimensionsString = yaml_emit($dimensionsAggregated);
preg_match_all('/\{!([0-9a-z-]{30,})!\}/', $dimensionsString, $matches);
$uuids = array_unique($matches[1]);
foreach ($uuids as $uuid) {
    $name = getActivityNameByUuid($uuid, $dimensionsAggregated);
    // echo "Adding dependsOn-comment for $uuid: $name\n";
    $dimensionsString = str_replace("'{!$uuid!}'", "$uuid # $name", $dimensionsString);
}

// Store generated data
$targetGeneratedFile = getcwd() . "/src/assets/YAML/generated/generated.yaml";
echo "\nStoring to $targetGeneratedFile\n";
file_put_contents($targetGeneratedFile, $dimensionsString);


// Store dependency graph
$graphFilename = getcwd() . "/src/assets/YAML/generated/dependency-tree.md";
$graphFile = fopen($graphFilename, "w");
fwrite($graphFile, "```mermaid\n\n");
fwrite($graphFile, "graph LR\n\n");
// List all nodes
foreach ($activityIndex as $activityName => $key) {
    $level = getActivityByActivityName($activityName,  $dimensionsAggregated)["level"];
    $activityName = "L$level $activityName";
    $activityName = str_replace('(', '', $activityName);
    $activityName = str_replace(')', '', $activityName);
    fwrite($graphFile, "$key($activityName)\n");
}
// Add links between nodes
fwrite($graphFile, "\n\n");
foreach ($dependencies as $dad => $children) {
    foreach ($children as $child) {
        fwrite($graphFile, "$dad --> $child\n");
    }
}
// Tie all orphans to a common start node
fwrite($graphFile, "\n");
foreach ($activityIndex as $activityName => $key) {
    $isOrphan = true;
    foreach ($dependencies as $dad => $children) {
        if ($dad == $key) continue;
        if (in_array($key, $children)) {
            $isOrphan = false;
            break;
        }
    }
    if ($isOrphan) {
        fwrite($graphFile, "O --> $key\n");
    }
}

// Close the file
fwrite($graphFile, "```\n");
fclose($graphFile);
echo "\nSaved dependency graph '$graphFilename'\n\n";



function assertUniqueRefs($all_references, &$errorMsg) {
    foreach ($all_references as $references) {
        assertUniqueRefByKey($references, 'uuid', $errorMsg);
        assertUniqueRefByKey($references, 'name', $errorMsg);
        assertUniqueRefByKey($references, 'url', $errorMsg);
        assertUniqueRefByKey($references, "\n  description", $errorMsg);
    }
}

function assertUniqueRefByKey($references, $keyToAssert, &$errorMsg) {
    $all_values = array();
    $printable_keyToAssert = $keyToAssert;
    $keyToAssert = trim($keyToAssert);

    foreach ($references as $key => $reference) {
        if (array_key_exists($keyToAssert, $reference)) {
            $value = $reference[$keyToAssert];
            // echo "$key: $value\n";
            if (array_key_exists($value, $all_values)) {
                array_push($errorMsg, "Duplicate '$keyToAssert' in reference file: '" . $all_values[$value] . "' and '$key': $printable_keyToAssert='$value'");
            } else {
                $all_values[$value] = $key;
            }
        }
    }
}


function assertSecureUrlsInRefs($all_references, &$errorMsg) {
    foreach ($all_references as $references) {
        foreach ($references as $id => $reference) {
            foreach ($reference as $key => $value) {   
                if (is_string($value)) {
                    // echo "KEY: $key VAL: " . var_dump($value) . "\n";
                    if (str_contains($value,'http://')) {
                        array_push($errorMsg, "Insecure url in '$key' of $id: " . $reference[$key]);
                    }
                }
            }
        }
    }
}


function assertLiveUrlsInRefs($all_references, &$errorMsg) {
    if (TEST_REFERENCED_URLS) {
        echo "\nTesting referenced URLs:\n";
        foreach ($all_references as $references) {
            foreach ($references as $key => $reference) {
                if (array_key_exists('url', $reference)) {
                    $url = $reference['url'];
                    echo "  $key: $url\n";
                    $err = assertLiveUrl($reference['url'], $reference['test-url-expects'] ?? []);
                    if ($err) {
                        echo "    # $err\n";
                        array_push($errorMsg, "Dead ref URL ($key): $err");
                    }
                }
            }
        }
        echo "\n";
    }
}


function assertLiveUrl($url, $expectedStatusCodes = []):string {
    $useragent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:135.0) Gecko/20100101 Firefox/135.0';

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_USERAGENT, $useragent);
    curl_setopt($curl, CURLOPT_HTTPHEADER, ['Accept-Language: en-US,en']);
    curl_setopt($curl, CURLOPT_NOBODY, true);
    curl_setopt($curl, CURLOPT_HEADER, true);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_TIMEOUT, 5);
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
    $response = curl_exec($curl);
    
    if (curl_errno($curl)) {
        echo curl_error($curl);
        curl_close($curl);
        return "No reply";
    }
    
    // Extract header info
    $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    $redirectUrl = curl_getinfo($curl,  CURLINFO_REDIRECT_URL );

    curl_close($curl);

    if (isExpectedStatusCode($statusCode, $expectedStatusCodes)) {   
        return "";
    }
    if ($statusCode == 301 || $statusCode == 302) {   
        return "Status code $statusCode redirects to: $redirectUrl";
    }
    return "Status code: $statusCode: $url";
}

function isExpectedStatusCode($statusCode, $expectedStatusCodes) {
    if (count($expectedStatusCodes) == 0) {
        return $statusCode == 200;
    }

    foreach ($expectedStatusCodes as $expectedStatusCode) {
        if ($statusCode == $expectedStatusCode) {
            return true;
        }
    }
    return false;
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


/*
* Traverse an array in-place and replaces yaml pointers.
 */
function resolveYamlReferences(&$data, $references, &$errorMsg)
{
    function resolveYamlReferencesCallback(&$value, $key, $payload)
    {
        if (!is_array($value)) {
            return;
        }

        if (!array_key_exists('$ref', $value)) {
            // Call recursively until $value contains a '$ref' child
            array_walk($value, "resolveYamlReferencesCallback", $payload);
            return;
        } else {
            list($context, $ref) = extractReference($value['$ref']);
            if (is_null($context) || is_null($ref)) {
                array_push($payload['errorMsg'],"Invalid syntax in reference file: '" . $value['$ref'] . "'");
            return;
        }
            if (!array_key_exists($context, $payload['references']) ||
                !array_key_exists($ref, $payload['references'][$context]) ) {
                array_push($payload['errorMsg'],"Reference does not exist: '$context/$ref'");
                return;
            }

            // Insert the actual reference object, instead of the reference link
            $value = $payload['references'][$context][$ref];
            $payload['usedRefs']["$context/$ref"] = true;
        }
    }


    // Call resolve_yaml_references_cb for each and every node in the data array
    $usedRefs = array();
    $payload = array('references' => &$references, 'errorMsg' => &$errorMsg, 'usedRefs' => &$usedRefs);
    array_walk($data, "resolveYamlReferencesCallback", $payload);

    // Inform of unused references
    echo "\n";
    foreach ($references as $context => $refs) {
        foreach ($refs as $ref => $refData) {
            if (!array_key_exists("$context/$ref", $usedRefs)) {
                echo "INFO: Reference never used: $context: $ref\n";
            }
        }
    }
}


/*
 * Extract the context id and the reference id from the '$ref' value in the yaml
 */
function extractReference($str) {
    $regExp = "~#/([\w-]+)/([\w-]+)~";
    if (preg_match($regExp, $str, $matches)) {
        return array($matches[1], $matches[2]);
    }
    return null;
}
