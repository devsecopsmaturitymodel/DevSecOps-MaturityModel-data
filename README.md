# OWASP DevSecOps Maturity Model Data
Data for the OWASP DevSecOps Maturity Model.

## Usage
To test changes to the yaml-files, please run:
```
docker run -ti -v $(pwd)/src/assets/YAML/:/var/www/html/src/assets/YAML wurstbrot/dsomm-yaml-generation
