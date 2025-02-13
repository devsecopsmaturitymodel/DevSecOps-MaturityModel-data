# OWASP DevSecOps Maturity Model Data
Data for the OWASP DevSecOps Maturity Model.

## Usage
To test changes to the yaml-files, please run:
```bash
docker run -ti -v $(pwd)/src/assets/YAML/default:/var/www/html/src/assets/YAML/default -v $(pwd)/src/assets/YAML/generated:/var/www/html/src/assets/YAML/generated -v $(pwd)/src/assets/YAML/schema:/var/www/html/src/assets/YAML/schema wurstbrot/dsomm-yaml-generation

# Afterwards, you can use the generated.yaml in a container
docker  run -v $(pwd)/src/assets/YAML/generated/generated.yaml:/usr/share/nginx/html/assets/YAML/generated/generated.yaml -p 8080:8080 wurstbrot/dsomm
```

## Credits

* The dimension _Test and Verification_ is based on Christian Schneiders [Security DevOps Maturity Model (SDOMM)](https://www.christian-schneider.net/SecurityDevOpsMaturityModel.html). _Application tests_ and _Infrastructure tests_ are added by Timo Pagel. Also, the sub-dimension _Static depth_ has been evaluated by security experts at [OWASP Stammtisch Hamburg](https://www.owasp.org/index.php/OWASP_German_Chapter_Stammtisch_Initiative/Hamburg).
* The sub-dimension <i>Process</i> has been added after a discussion with [Francois Raynaud](https://www.linkedin.com/in/francoisraynaud/) that reactive activities are missing.
* Enhancement of my basic translation is performed by [Claud Camerino](https://github.com/clazba).
* Adding ISO 27001:2017 mapping, [Andre Baumeier](https://github.com/AndreBaumeier).
* [OWASP Project Integration Project Writeup](https://github.com/OWASP/www-project-integration-standards/blob/master/writeups/owasp_in_sdlc/index.md) for providing documentation on different DevSecOps practices which are copied&pasted/ (and adopted) (https://github.com/northdpole, https://github.com/ThunderSon)
* The requirements from [level 0](https://github.com/AppSecure-nrw/security-belts/blob/master/white/) are based on/copied from [AppSecure NRW](https://appsecure.nrw/)
* The sub dimension _Test KPI_, _Triage_, _Dynamic depth for app/infra_, _Static depth for app/infra_ and some other vulnerability management activities are based/inspired by [Vulnerability Managment Maturity Model - Cheat Sheet V1.6](TODO FRANCESCO LINK)
