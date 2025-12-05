# OWASP DevSecOps Maturity Model Data

This GitHub project ([DevSecOps-MaturityModel-data](https://github.com/devsecopsmaturitymodel/DevSecOps-MaturityModel-data)) contains the source for the DSOMM *model*. The model is used by the DSOMM applciation [DevSecOps-MaturityModel](https://github.com/devsecopsmaturitymodel/DevSecOps-MaturityModel). 

The source files include dimensions, activities, descriptions, measures, and other model data used by the application.


## Contribution

Contributions that improve the DSOMM model are welcome. Please edit the source files under `src/assets/YAML/default/*` and open a pull request.


### Testing

After making changes, generate a new `model.yaml` and use it in a local DSOMM application to verify there are no technical issues.


## Usage

The script is executed using `docker` (or alternatively `podman`).
Depending on your platform use either `generateDimensions.bash` (Linux) or `generateDimensions.bat` (Windows). 

1. Clone the repo:

   `git clone https://github.com/devsecopsmaturitymodel/DevSecOps-MaturityModel-data.git`

2. Change directory:

   `cd yaml-generation`

3. Generate `model.yaml`:

   `./generateDimensions.bash`



### Starting a local DSOMM application

To start a local DSOMM instance on http://localhost:8080, run:

  - `./generateDimensions.bash --start-dsomm`


### Test referenced URLs

To test all URLs referenced by `implementations.yaml` and save results to `url-test-results.txt`, run:

  - `./generateDimensions.bash --test-urls`


### Using Podman instead of Docker

If you prefer Podman over Docker, set the environement variable `DOCKER_CMD` to `podman`, or edit the script for you operating system.


## Credits

- The "Test and Verification" dimension is based on Christian Schneider's Security DevOps Maturity Model (SDOMM).
- Application and infrastructure tests were added by Timo Pagel.
- The "Process" sub-dimension was added after discussion with Francois Raynaud.
- Translations and edits were contributed by Claud Camerino.
- ISO 27001:2017 mapping by Andre Baumeier.
- Other inspirations and contributions are acknowledged in the original README.


## License

See the `LICENSE` file in this repository for license details.
