#!/bin/bash

# Funktion zur Konvertierung von DSOMM zu SAMM Format
convert_dsomm_to_samm() {
    local input_file="$1"
    local output_file="$2"
    
    if [[ -z "$input_file" ]]; then
        echo "Verwendung: convert_dsomm_to_samm <input_file> [output_file]"
        echo "Beispiel: convert_dsomm_to_samm document.txt converted_document.txt"
        return 1
    fi
    
    if [[ ! -f "$input_file" ]]; then
        echo "Fehler: Datei '$input_file' nicht gefunden!"
        return 1
    fi
    
    # Wenn keine Output-Datei angegeben, verwende Input-Datei mit _converted Suffix
    if [[ -z "$output_file" ]]; then
        output_file="${input_file%.*}_converted.${input_file##*.}"
    fi
    
    echo "Konvertiere DSOMM Referenzen zu SAMM Format..."
    echo "Input: $input_file"
    echo "Output: $output_file"
    
    # Sed-Befehl zur Umwandlung:
    # Sucht nach Pattern: BUCHSTABE-BUCHSTABEN-ZAHL-BUCHSTABE
    # Wandelt um zu: BUCHSTABE-BUCHSTABEN-BUCHSTABE-ZAHL
    sed -E 's/([A-Z]+-[A-Z]+)-([0-9]+)-([A-Z]+)/\1-\3-\2/g' "$input_file" > "$output_file"
    
    echo "Konvertierung abgeschlossen!"
    echo "Überprüfe die ersten konvertierten Zeilen:"
    head -10 "$output_file" | grep -E '[A-Z]+-[A-Z]+-[A-Z]+-[0-9]+' || echo "Keine konvertierten Referenzen in den ersten 10 Zeilen gefunden."
}

# Direkte Verwendung für eine einzelne Zeile (für Tests):
convert_single_reference() {
    local ref="$1"
    echo "$ref" | sed -E 's/([A-Z]+-[A-Z]+)-([0-9]+)-([A-Z]+)/\1-\3-\2/g'
}

# Beispiel-Test mit den von Ihnen bereitgestellten Referenzen:
echo "=== Test der Konvertierung ==="
echo "Original → Konvertiert:"
echo "G-SM-1-A → $(convert_single_reference 'G-SM-1-A')"
echo "D-TA-2-B → $(convert_single_reference 'D-TA-2-B')"
echo "V-RT-3-A → $(convert_single_reference 'V-RT-3-A')"
echo "O-OM-1-B → $(convert_single_reference 'O-OM-1-B')"

# Funktion zum Suchen und Konvertieren aller YAML-Dateien
process_all_yaml_files() {
    echo "Suche nach YAML-Dateien im aktuellen Verzeichnis und Unterverzeichnissen..."
    
    # Finde alle .yaml Dateien
    mapfile -t yaml_files < <(find . -name "*.yaml" -type f)
    
    if [[ ${#yaml_files[@]} -eq 0 ]]; then
        echo "Keine YAML-Dateien gefunden."
        return 1
    fi
    
    echo "Gefundene YAML-Dateien: ${#yaml_files[@]}"
    
    # Bestätigung vom Benutzer einholen
    echo ""
    echo "Folgende YAML-Dateien wurden gefunden:"
    printf '%s\n' "${yaml_files[@]}"
    echo ""
    read -p "Möchten Sie alle diese Dateien konvertieren? (y/N): " -n 1 -r
    echo ""
    
    if [[ ! $REPLY =~ ^[Yy]$ ]]; then
        echo "Abgebrochen."
        return 0
    fi
    
    # Backup-Verzeichnis erstellen
    backup_dir="./backup_$(date +%Y%m%d_%H%M%S)"
    mkdir -p "$backup_dir"
    echo "Backups werden in '$backup_dir' erstellt..."
    
    # Konvertierung durchführen
    local converted_count=0
    local total_count=${#yaml_files[@]}
    
    for yaml_file in "${yaml_files[@]}"; do
        echo "Verarbeite: $yaml_file"
        
        # Backup erstellen
        backup_file="$backup_dir/${yaml_file#./}"
        mkdir -p "$(dirname "$backup_file")"
        cp "$yaml_file" "$backup_file"
        
        # Prüfen ob DSOMM Referenzen vorhanden sind
        if grep -qE '[A-Z]+-[A-Z]+-[0-9]+-[A-Z]+' "$yaml_file"; then
            # Konvertierung durchführen (in-place)
            sed -i.tmp -E 's/([A-Z]+-[A-Z]+)-([0-9]+)-([A-Z]+)/\1-\3-\2/g' "$yaml_file"
            rm "$yaml_file.tmp" 2>/dev/null
            ((converted_count++))
            echo "  ✓ Konvertiert"
        else
            echo "  - Keine DSOMM Referenzen gefunden"
        fi
    done
    
    echo ""
    echo "=== Konvertierung abgeschlossen ==="
    echo "Verarbeitete Dateien: $total_count"
    echo "Konvertierte Dateien: $converted_count"
    echo "Backups gespeichert in: $backup_dir"
    
    if [[ $converted_count -gt 0 ]]; then
        echo ""
        echo "Beispiele konvertierter Referenzen:"
        find . -name "*.yaml" -type f -exec grep -H -E '[A-Z]+-[A-Z]+-[A-Z]+-[0-9]+' {} \; | head -5
    fi
}

# Hauptfunktion aufrufen wenn Argumente übergeben wurden
if [[ $# -gt 0 ]]; then
    if [[ "$1" == "--all-yaml" || "$1" == "-a" ]]; then
        process_all_yaml_files
    else
        convert_dsomm_to_samm "$@"
    fi
else
    echo "DSOMM zu SAMM Referenz Konverter"
    echo "================================"
    echo ""
    echo "Verwendung:"
    echo "  $0 <input_file> [output_file]     # Einzelne Datei konvertieren"
    echo "  $0 --all-yaml | -a                # Alle YAML-Dateien konvertieren"
    echo ""
    echo "Beispiele:"
    echo "  $0 document.txt"
    echo "  $0 document.txt converted_document.txt"
    echo "  $0 --all-yaml                     # Alle .yaml Dateien im Verzeichnis"
    echo ""
    echo "Das Script konvertiert DSOMM Referenzen im Format:"
    echo "  <p>-<business-f>-<level>-<stream>"
    echo "zu SAMM Format:"
    echo "  <p>-<business-f>-<stream>-<level>"
    echo ""
    echo "Bei --all-yaml wird automatisch nach .yaml Dateien gesucht und"
    echo "Backups vor der Konvertierung erstellt."
fi
