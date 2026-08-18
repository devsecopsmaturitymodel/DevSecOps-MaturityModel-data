# Schreibstil-Profil der DSOMM-Aktivitäten (Nicht-AI-YAMLs)

Dieses Profil erfasst den Schreibstil aller YAML-Einträge unter `src/assets/YAML/` **außerhalb** von `default/AI/` – also der Dimensionen Information Gathering, Culture and Organization, Implementation, Build and Deployment, Test and Verification sowie `implementations.yaml`, `meta.yaml`, `teams.yaml`. Es dient als Vorlage, um neue Einträge (z. B. für AI) stilistisch konsistent zu formulieren.

## 1. Gesamtcharakter

- **Sprache:** Englisch, durchgehend amerikanische Schreibweise („organization", „behavior", „analyze"). Deutlich erkennbarer Nicht-Muttersprachler-Stil (deutsche Autorenschaft) im älteren Bestand.
- **Register:** knapp, checklistenartig, Praktiker-zu-Praktiker. DevSecOps-Jargon wird ohne Erklärung vorausgesetzt (SAST, DAST, SCA, four-eyes principle, egress filtering). Kein Marketing-Ton.
- **Zwei Schichten sind klar unterscheidbar:**
  1. **Legacy-Einträge:** kurz, passivisch, fragmentarisch, mit stehengelassenen Tippfehlern und Platzhaltern (`TODO`, `comments: ""`). Wirken wie ein lebendes Arbeitsdokument, nicht wie polierte Doku.
  2. **Neuere Einträge (ab ca. 2024):** flüssiges Englisch, aktiv/imperativisch, längere Sätze, Gedankenstriche, strukturierte `description`- und `assessment`-Blöcke, konkrete Realwelt-Referenzen und Human-in-the-loop-Vorbehalte („AI verdicts are input to triage, not a substitute for it").
- **Empfehlung für neue Einträge:** Konventionen und Ton der neueren Schicht übernehmen (fehlerfreies, imperatives Englisch), aber Struktur, Feldstil und Knappheit des Bestands beibehalten. Tippfehler des Altbestands sind Beschreibung, keine Vorschrift.

## 2. Struktur eines Aktivitätseintrags

Hierarchie: `Dimension:` → `Subdimension:` → `Aktivitätsname:` → Felder. Jede Datei beginnt mit einer Schema-Zeile und `---`:

```yaml
# yaml-language-server: $schema=../../schemas/dsomm-schema-<dimension>.json
---
```

Typische Feldreihenfolge (in der Praxis nicht streng eingehalten – `description`, `level` und `dependsOn` „wandern"):

```yaml
Aktivitätsname:
  uuid: <lowercase UUIDv4>          # immer erstes Feld
  risk: ...
  measure: ...
  description: ...                  # optional (~40 % der Einträge), Markdown
  assessment: ...                   # optional, Markdown-Bulletliste
  difficultyOfImplementation:
    knowledge: 1-5
    time: 1-5
    resources: 1-5
  usefulness: 1-5
  level: 1-5
  dependsOn: [...]                  # optional, sonst []
  implementation:                   # Liste von $ref oder []
    - $ref: src/assets/YAML/default/implementations.yaml#/implementations/<slug>
  references:
    samm2: [...]
    iso27001-2017: [...]
    iso27001-2022: [...]
  tags: [...]                       # optional, kebab-case
  comments: ""                      # fast immer leerer String am Ende
```

- **Aktivitätsnamen:** Nominalphrasen in Sentence case („Centralized application logging", „Require a PR before merging"). Häufiges Nominalisierungsmuster: „Conduction of …", „Creation of …", „Usage of …", „Definition of …". Vereinzelt Title Case als Ausnahme („Smoke Test", „Blue/Green Deployment").
- **Zahlenwerte:** immer nackte Integer 1–5, nie Strings, nie Dezimalzahlen. Die Label-Semantik („Very Low" … „Very High") liegt zentral in `meta.yaml`.
- **YAML-Idiome:** Prosa mal als Plain Scalar über mehrere Zeilen, mal als `|-` oder `|` – ohne erkennbare Regel (neuere Einträge tendieren zu `|`). Anker/Aliase und Merge-Keys kommen vor (`&automerge-PR`, `<<: *...`). Inline-`#`-Kommentare werden im Baum stehengelassen.
- **Leere Werte inkonsistent:** `""` vs. `[]` vs. nackter Key vs. Feld fehlt ganz.

## 3. Feldstile im Detail

### `risk`
Beschreibt die negative Folge, wenn die Aktivität **nicht** umgesetzt ist. Deklarative Aussagesätze im Präsens, keine Imperative, kein „Risk:"-Präfix.

- Starke Hedging-Modalverben: **„might"** (sehr häufig), „can", „may lead to".
- Häufige Einstiege: Negation („Without …", „Not …", „No …", „Failing to …") oder Nominalphrase als Subjekt („Vulnerabilities …", „Evil actors …").
- Viel Passiv; Satzfragmente ohne Verb sind im Altbestand akzeptiert („Insecure or unmaintainable code base.").
- Länge: 1 Satz (8–35 Wörter) im Altbestand; neuere Einträge 2–3 Sätze mit Ursache-Wirkungs-Kette.

Beispiele (wörtlich):
> „Trends and advanced attacks are not detected."
> „Using an insecure application might lead to a compromised application. This might lead to total data theft or data modification."
> „Without measuring Mean Time to Resolution (MTTR) related to patching, it is challenging to identify delays in the patching process. Unaddressed vulnerabilities can be exploited by attackers, leading to potential security breaches and data loss."

### `measure`
Beschreibt die Maßnahme bzw. den Zielzustand. Drei koexistierende Muster:

1. **Nominalphrasen-Fragmente** (alt): „Measurement and communication of …", „Gathering of system calls.", „Check for known vulnerabilities"
2. **Passive Zustandsbeschreibung** (alt): „Containers are running as non-root.", „Vulnerabilities are tracked in the teams issue system (e.g. jira)."
3. **Imperativ** (neu): „Implement a centralized logging solution for all critical systems.", „Mandate blocking of force pushes in the version control platform."

Länge: 4 Wörter bis kurzer Absatz; neuere Einträge nutzen auch Markdown-Bulletlisten. Nachgestellte Fragmentsätze kommen vor („At least quarterly.").

### `description`
Das reichste Feld, volles Markdown:

- Überschriften (`#`/`###`), `-`-Bullets (dominant; `*` kommt im Altbestand vor), **Fett** für Labels („**Example High Maturity Scenario:**"), Kursiv per `_underscore_`, Inline-Links, Bilder, Codeblöcke, Backticks für Fachbegriffe.
- **Definitorischer Einstieg** als Muster: „X is/refers to …" – z. B. „Pinning artifacts in Dockerfile refers to the practice of using specific, immutable versions …".
- Quellenangaben am Ende: „[Source: OWASP SAMM](…)" oder „Source: OWASP Project Integration Project".
- Wiederkehrendes Emoji-Bullet in Schulungsinhalten: „:unicorn: (special things of your application)".
- Copy-Paste-Wiederverwendung identischer Absätze über verwandte Aktivitäten hinweg ist normal (z. B. WAF baseline/medium/advanced).
- HTML fast nie; einzige Ausnahme vereinzeltes `<i>…</i>`.

### `assessment`
Immer eine Markdown-`-`-Bulletliste mit prüfbaren Nachweisen, 1–4 Punkte. Mischung aus Imperativ („Show your build pipeline configuration (e.g., Jenkinsfile, GitHub Actions workflow) …", „Demonstrate …") und Deklarativ („Attendance records are available"). Schlusspunkte uneinheitlich.

### `comments` / `credits`
`comments` ist fast immer der leere String `""` (Boilerplate). Wenn befüllt: kurze, meinungsstarke Prosa („False positive analysis, specially for static analysis, is time consuming.") oder Markdown-Links. `credits` als Markdown-Link-Fragment: „AppSecure-nrw [Security Belts](https://github.com/AppSecure-nrw/security-belts/)".

## 4. `references`

```yaml
references:
  samm2:
    - I-DM-B-2                      # Codes wie G-EG-A-1, V-ST-A-2, O-EM-A-1
  iso27001-2017:
    - 16.1.4                        # nackte Klauselnummern, unsortiert
  iso27001-2022:
    - 5.25
    - 8.25 # Secure development lifecycle   # gelegentlich Inline-Kommentar mit Klauselname
```

- Fehlt eine Zuordnung, steht ein **Freitext-Disclaimer als Listenelement** in derselben Liste, mit uneinheitlicher Groß-/Kleinschreibung:
  - „Not explicitly covered by ISO 27001 - too specific" (auch klein geschrieben)
  - „ISO 27001:2022 mapping is missing" / „ISO 27001:2017 mapping is missing"
  - „May be part of risk assessment"
- `samm2: []` bei fehlender Zuordnung; neuere Einträge lassen `iso27001-2017` teils ganz weg.
- Selten Zusatzschlüssel: `openCRE:` (volle URL), `d3f:` (CamelCase-Techniknamen wie `Multi-factorAuthentication`).

## 5. `dependsOn`

Zwei gleichberechtigte Konventionen, oft gemischt:

```yaml
dependsOn:
  - Defined build process                                    # exakter Aktivitätsname (älter)
  - 8a442d8e-0eb1-4793-a513-571aef982edd # Alerting          # UUID + Namens-Kommentar (neuer)
```

Leere Liste explizit als `dependsOn: []`. Kommentartexte sind teils abgekürzt oder weichen vom echten Titel ab („# Def. Build Process", „# EPSS/CISA KEV").

## 6. `implementations.yaml`

```yaml
<kebab-slug>:                       # historisch auf ~20 Zeichen gekürzt: owasp-dependency-che
  uuid: <UUIDv4>
  name: Flux CD
  tags: [deployment]                # Flow-Style, oft []
  url: https://fluxcd.io/           # optional
  description: |-
    GitOps controller for Kubernetes that continuously reconciles …
```

- `description` reicht vom Drei-Wort-Fragment („Attack matrix for cloud") über Tool-Blurbs bis zu lockerem Rat („… an option is to use the OWASP JuiceShop on a ‚hacking Friday'").
- Manche „Implementations" sind keine Tools, sondern ganze Ratschlagssätze als `name` („A Point in Time Recovery for databases should be implemented.").

## 7. Sprachliche Eigenheiten (deskriptiv)

Diese Merkmale prägen den Bestand – beim Nachahmen den Ton treffen, die Fehler aber nicht reproduzieren:

- **Passiv-Dominanz** im Altbestand („are gathered", „is performed"), inkl. Germanismus „are getting + Partizip" („are not getting tracked").
- **Typische wiederkehrende Fehler:** „specially" statt „especially" (systematisch), „the hole organization" (whole), „Two ore more", „might exists", „alarms are send out", „unsecure" statt „insecure", überflüssige Kommas nach deutschem Muster.
- **Deutsche Bindestrich-Komposita:** „Coverage- and control-metrics", „packet- or application-firewalls".
- **`e.g.`** extrem häufig, meist ohne folgendes Komma (neuere Einträge: „e.g.,"); einfache Anführungszeichen für Literale (‚admin', ‚cat'); `->`-Pfeile und `...` in Klammern.
- **Abkürzungen** werden bei Ersteinführung in Klammern ausgeschrieben und dann wiederverwendet: MTTR, SLA, RPO/RTO, SBOM, WAF, EPSS, CISA KEV, KPI.
- **Wortwahl-Eigenheiten:** Angreifer heißen wiederkehrend „evil actors"/„evil administrators"; gelegentlich Ich-Perspektive als Angreifer-Narrativ („As an attacker, I compromise a system, gather credentials and try to use them.") und trockener Humor („Security joke: We will gain 100% false negatives.").
- **Leseransprache:** Altbestand unpersönlich in dritter Person; „you/your" nur in Community-/SAMM-Zitaten und neueren Texten („Find a tool that suits your environment.").
- **Konkretion:** Toolnamen und Schwellwerte direkt in der Prosa („Use a tool like trivy", „in under 10 minutes", „At least quarterly.", „e.g. 30 years").
- **Arbeitsdokument-Artefakte** werden committet: `TODO`/`TOODO`, auskommentierte Referenzen, Inline-Fragen als `#`-Kommentar, `comments: ""`-Gerüst.

## 8. Kurzrezept für neue Einträge

1. `uuid` zuerst, Integer-Ratings 1–5, Feldgerüst wie in Abschnitt 2.
2. `risk`: 1–3 deklarative Sätze über die Folge des Unterlassens, mit „might/can lead to"; keine Imperative.
3. `measure`: Imperativ oder Zielzustands-Beschreibung, konkret, gern mit Toolbeispielen in Klammern („e.g. …"); bei mehreren Schritten Markdown-Bullets.
4. `description` (optional): definitorischer Einstieg („X is/refers to …"), Markdown mit `-`-Bullets, ggf. „### Benefits", Quellenangabe am Ende.
5. `assessment` (optional): 2–4 prüfbare Nachweise als `-`-Bullets, imperativisch („Show …", „Demonstrate …").
6. `references`: samm2-Code(s); ISO-Klauseln als nackte Nummern; fehlende Zuordnung als Freitext-Disclaimer in der Liste.
7. `dependsOn`: UUID + `# Aktivitätsname`-Kommentar (neuere Konvention bevorzugen).
8. `tags` kebab-case, klein; Abschluss mit `comments: ""`.
9. Ton: knapp, sachlich, praktikerorientiert, amerikanisches Englisch; Hedging über „might", Empfehlungen über „should be considered"/„A good practice is to …".
