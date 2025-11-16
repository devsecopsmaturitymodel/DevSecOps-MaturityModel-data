#!/bin/bash

# Usage:
#    ./generateDimensions.bash --install     First time, install composer dependencies
#    ./generateDimensions.bash               Generate activities.yaml
#    ./generateDimensions.bash --test-urls   Test URLs in implementations.yaml

cd "$(dirname "$0")"/..
pwd 

# Use: docker | podman
DOCKER=docker 

if [ "$1" = "--install" ]; then
    echo Installing composer dependencies...
    MSYS_NO_PATHCONV=1 $DOCKER run -ti --rm --volume ${PWD}:/app wurstbrot/dsomm-yaml-generation bash -c 'cd /app/yaml-generation && composer install --no-interaction --no-plugins --no-scripts --prefer-dist'

elif [ "$1" = "--start-dsomm" ]; then
    echo "Starting local DSOMM application..."
    MSYS_NO_PATHCONV=1 $DOCKER run -ti --rm --volume $(pwd)/src/assets/YAML/generated/generated.yaml:/srv/assets/YAML/generated/generated.yaml -p 8080:8080 wurstbrot/dsomm

elif [ "$1" = "--test-urls" ]; then
    echo "Test URLs in implementations.yaml..."
    MSYS_NO_PATHCONV=1 $DOCKER run -e TEST_REFERENCED_URLS=true -ti --rm --volume ${PWD}:/app wurstbrot/dsomm-yaml-generation bash -c 'cd /app/ && php yaml-generation/generateDimensions.php' | tee url-test-results.txt

else
    echo "Generating activities.yaml..."
    MSYS_NO_PATHCONV=1 $DOCKER run -ti --rm --volume ${PWD}:/app wurstbrot/dsomm-yaml-generation bash -c 'cd /app/ && php yaml-generation/generateDimensions.php'

fi
