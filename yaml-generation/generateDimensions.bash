#!/bin/bash

# Usage:
#    ./generateDimensions.bash                 Generate model.yaml
#    ./generateDimensions.bash --test-urls     Test URLs in implementations.yaml
#    ./generateDimensions.bash --start-dsomm   Run local DSOMM with generated model.yaml

cd "$(dirname "$0")"/..

# Use: docker | podman
if [ -z "${DOCKER_CMD}" ]; then
    DOCKER_CMD=docker
fi

echo Installing composer dependencies...
MSYS_NO_PATHCONV=1 $DOCKER_CMD run -ti --rm --volume "${PWD}:/app" wurstbrot/dsomm-yaml-generation bash -c 'cd /app/yaml-generation && composer install --no-interaction --no-plugins --no-scripts --prefer-dist'

if [ "$1" = "--start-dsomm" ]; then
    echo "Starting local DSOMM application..."
    MSYS_NO_PATHCONV=1 $DOCKER_CMD run -ti --rm --volume "${PWD}/generated/model.yaml:/srv/assets/YAML/default/model.yaml" -p 8080:8080 wurstbrot/dsomm

elif [ "$1" = "--test-urls" ]; then
    echo "Test URLs in implementations.yaml..."
    MSYS_NO_PATHCONV=1 $DOCKER_CMD run -e TEST_REFERENCED_URLS=true -ti --rm --volume "${PWD}:/app" wurstbrot/dsomm-yaml-generation bash -c 'cd /app/ && php yaml-generation/generateDimensions.php' | tee url-test-results.txt

else
    echo "Generating model.yaml..."
    MSYS_NO_PATHCONV=1 $DOCKER_CMD run -e USERNAME=${USER:-$USERNAME} -ti --rm --volume "${PWD}:/app" wurstbrot/dsomm-yaml-generation bash -c 'cd /app/ && php yaml-generation/generateDimensions.php'
fi
