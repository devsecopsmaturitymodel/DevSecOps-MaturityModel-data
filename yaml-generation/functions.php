<?php
/**
 * functions.php
 *
 * @package default
 * @see data.php
 * @see mappings.php
 * @see newFolder-Migration-2021.php
 * @see scutter.php
 * @see test-yaml.php
 * @see data/generateDimensions.php
 */


include_once "bib.php";


/**
 *
 * @param unknown $file
 * @return unknown
 */
function readYaml($file) {
    $fragment = null;
    if (strpos($file, "#") != false) {
        list($file, $fragment) = explode("#", $file,  2);
        $fragment = trim($fragment, "/ ");
    }
    if (!file_exists($file)) {
        echo "$file doesn't exists or can not be accessed";
        exit;
    }
    $ret = yaml_parse(
        file_get_contents($file)
    );
    if ($fragment) {
        foreach (explode("/", $fragment) as $key) {
            if (array_key_exists($key, $ret)) {
                $ret = $ret[$key];
            }
        }

    }

    if (isset($ret['_yaml_references'])) {
        foreach ($ret['_yaml_references'] as $include) {
            if (preg_match('/^include\((\w+),\s*(.+)\)$/', $include, $matches)) {
                $team = $matches[1];
                $baseDir = dirname($file);

                $includeFile = $baseDir . DIRECTORY_SEPARATOR . $matches[2];
                echo "In file $file, including $includeFile for team $team\n";
                $includedContent = includeYamlAndSetTeamImplemented($includeFile, $team);
                $ret = array_merge_recursive_ex($ret, $includedContent);
            }
        }
        unset($ret['_yaml_references']);
    }

    return $ret;
}

function includeYamlAndSetTeamImplemented($filename, $team) {
    echo "File to include $filename";
    $content = yaml_parse_file($filename);
    if ($content === false) {
        echo "Error parsing YAML file: $filename\n";
        return array();
    }
    // Add teamsImplemented for each activity
    foreach ($content as $dimension => $subdimensions) {
        foreach ($subdimensions as $subdimension => $elements) {
            foreach ($elements as $activityName => $activity) {
                if (is_array($elements) && (isset($activity['teamsEvidence']) || isset($activity['teamsImplemented']))) {
                    if (!isset($activity['teamsImplemented'])) {
                        echo "# setting teamsImplemented first time for team $team";
                        $content[$dimension][$subdimension][$activityName]['teamsImplemented'] = array();
                    }
                    if(array_key_exists('teamsEvidence', $activity)) {
                        echo "# adding team to teamsImplemented for team $team";
                        $content[$dimension][$subdimension][$activityName]['teamsImplemented'][$team] = true ;
                    }
                }
            }
        }
    }
    return $content;

}

/**
 * Get dimensions from yaml file.
 *
 * @param unknown $filename (optional)
 * @return array
 */
function getDimensions($filename = "data/generated/dimensions.yaml") {
    $dimensions = readYaml($filename);

    // reorder in-place $dimensions. This should wrap readYaml(data/dimensions.yaml)
    ksort($dimensions);
    foreach ($dimensions as $dimensionName => $subDimension) {
        ksort($subDimension);
        foreach ($subDimension as $subDimensionName => $elements) {
            // Q: should I retain this?
            if (substr($subDimensionName, 0, 1) == "_")
                continue;

            // Upgrade old configuration to `references:`
            //   this code can be modified to other models.
            foreach ($elements as $activityName => $content) {
                if ($content["references"] ?? null) // ignore new lines
                    continue;
                $content["references"]["samm2"] = $content["samm2"] ?? array();
                unset($content["samm2"]);
                $content["references"]["iso27001-2017"] = $content["iso27001-2017"] ?? array();
                unset($content["iso27001-2017"]);
                $content["references"]["iso27001-2022"] = $content["iso27001-2022"] ?? array();
                unset($content["iso27001-2022"]);
                //echo var_dump($elements[$activityName]);
                //echo "<hr>";

                if (!array_key_exists("tags", $content)) {
                    $content["tags"] = array();
                    $content["tags"][] = "none";
                }
                unset($content["isImplemented"]);
                unset($content["evidence"]);
                $elements[$activityName] = $content;
            }
            $newElements = $elements;
            ksort($newElements);
            $dimensions[$dimensionName][$subDimensionName] = $newElements;
        }
    }
    return $dimensions;
}



/**
 * This function should be a sort of db wrapper.
 *
 * @param unknown $dimensions
 */
function getActions($dimensions) {
    ksort($dimensions);
    foreach ($dimensions as $dimension => $subdimensions) {
        ksort($subdimensions);

        foreach ($subdimensions as $subdimension => $elements) {
            if (substr($subdimension, 0, 1) == "_")
                continue;

            yield array($dimension, $subdimension, $elements);
        }
    }
}

function getSubdimensionCount($dimensions) {
    $count=0;
    foreach ($dimensions as $dimension => $subdimensions) {
        foreach ($subdimensions as $subdimension => $elements) {
            $count++;
        }
    }
    return $count;
}


/**
 *
 * @return unknown
 */
function getReferenceLabels() {
    return readYaml("data/strings.yml#/strings/en/references");
}


/**
 *
 * @param unknown $reference_id
 * @return unknown
 */
function getReferenceLabel($reference_id) {
    $referenceLabels = readYaml("data/strings.yml#/strings/en/references");

    return $referenceLabels[$reference_id]["label"] ?? $reference_id;
}


function getActivityNameByUuid($uuid, $dimensionsAggregated) {
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
                if($activity["uuid"] == $uuid) {
                    return $activityName;
                }
            }
        }
    }
    return null;
}


function getUuidByActivityName($activityName, $dimensionsAggregated) {
    $activity = getActivityByActivityName($activityName, $dimensionsAggregated);
    if ($activity) {
        return $activity["uuid"];
    } else {
        return null;
    }
}


function getActivityByActivityName($activityName, $dimensionsAggregated) {
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

            if (array_key_exists($activityName, $elements)) {
                return $elements[$activityName];
            }
        }
    }
    return null;
}


/**
 *
 * @param unknown $headings
 */
function thead($headings) {
    echo '<thead><tr><th scope="col">'
        .implode('</th><th scope="col">', $headings)
        .'</th></tr></thead>';
}


/**
 *
 * @param unknown $title
 * @param unknown $html_content
 * @param unknown $html_tooltip
 * @return unknown
 */
function div_tooltip($title, $html_content, $html_tooltip) {
    $tooltip =  "<div class='popoverdetails'>" .$html_tooltip . "</div>";
    return "<div data-toggle=\"popover\"
        data-title=\"$title\"
        data-activity=\".$html_tooltip\"
        type=\"button\" data-html=\"true \">" . $html_content . "</div>";
}


/**
 *
 * @param unknown $samm_reference
 * @return unknown
 */
function renderSamm($samm_reference) {
    return "$samm_reference";
}


/**
 *
 * @param unknown $items
 */
function as_list($items) {
    if (is_array($items)) {
        yield from $items;
    } else {
        yield $items;
    }
}


/**
 *
 * @param unknown $samm_references
 * @param unknown $callback        (optional)
 * @return unknown
 */
function ul($samm_references, $callback='renderSamm') {
    if ( ! is_array($samm_references) ) {
        return ($callback)($samm_references);
    }

    $ret = "<ul><li>"
        . implode("</li><li>", array_map($callback, $samm_references))
        ."</li></ul>";
    return $ret;
}


/**
 *
 * @param unknown $references
 */
function getReferences($references) {
    foreach ($references as $r_name => $rlist) {

    }

}


// TODO create testcases


/**
 *
 */
function test_getActions() {
    $dimensions = readYaml("data/generated/dimensions.yaml");
    echo var_dump(getActions($dimensions));
}


/**
 *
 */
function test_readYaml() {
    $ret = readYaml("data/strings.yml");
    echo var_dump($ret);
    echo "<hr>";
    $ret = readYaml("data/strings.yml#/strings/en");
    echo var_dump($ret);
    echo "<hr>";
}


?>
