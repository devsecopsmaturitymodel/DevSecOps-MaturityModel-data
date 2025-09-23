@echo off
REM Usage: generateDimensions.bat [--test-urls]
REM If --test-urls is provided, the script will check if referenced URLs are live.

setlocal
SET var=DUMMY=
if "%~1"=="--test-urls"  SET var=TEST_REFERENCED_URLS=true


REM Change working directory to the project root
cd %~dp0\..

REM Run the php script in the Docker container 
docker run -e %var% -e IS_IMPLEMENTED_WHEN_EVIDENCE=true -ti --rm --volume "%CD%:/app" wurstbrot/dsomm-yaml-generation bash -c "cd /app/ && php yaml-generation/generateDimensions.php"

