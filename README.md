# OWASP DevSecOps Maturity Model Data
Data for the OWASP DevSecOps Maturity Model.

## Usage
To test changes to the yaml-files, please run:
```bash
docker run -ti -v $(pwd)/src/assets/YAML/:/var/www/html/src/assets/YAML wurstbrot/dsomm-yaml-generation
# Afterwards, you can use the generated.yaml in a container
docker  run -v $(pwd)/src/assets/YAML/generated/generated.yaml:/usr/share/nginx/html/assets/YAML/generated/generated.yaml -p 8080:8080 wurstbrot/dsomm
```
