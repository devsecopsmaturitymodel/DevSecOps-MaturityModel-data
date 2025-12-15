@echo off

REM Usage:
REM    ./generateDimensions.bash                 Generate model.yaml
REM    ./generateDimensions.bash --test-urls     Test URLs in implementations.yaml
REM    ./generateDimensions.bash --start-dsomm   Run local DSOMM with generated model.yaml

setlocal
REM Change working directory to the project root
cd %~dp0\..

REM Use: docker | podman
if "%DOCKER_CMD%"=="" (
    set DOCKER_CMD=docker
)

echo Installing composer dependencies...
%DOCKER_CMD% run -ti --rm --volume "%CD%:/app" wurstbrot/dsomm-yaml-generation bash -c "cd /app/yaml-generation && composer install --no-interaction --no-plugins --no-scripts --prefer-dist"

if "%~1"=="--start-dsomm" (
    echo Start local DSOMM application...
    %DOCKER_CMD% run -ti --rm --volume "%CD%/generated/model.yaml:/srv/assets/YAML/default/model.yaml" -p 8080:8080 wurstbrot/dsomm

) else if "%~1"=="--test-urls" (
    echo Test URLs in implementations.yaml...
    %DOCKER_CMD% run -e TEST_REFERENCED_URLS=true -ti --rm --volume "%CD%:/app" wurstbrot/dsomm-yaml-generation bash -c "cd /app/ && php yaml-generation/generateDimensions.php" | tee url-test-results.txt

) else (
    echo Generate model.yaml...
    %DOCKER_CMD% run -e USERNAME=%USERNAME% -ti --rm --volume "%CD%:/app" wurstbrot/dsomm-yaml-generation bash -c "cd /app/ && php yaml-generation/generateDimensions.php"
    
)

