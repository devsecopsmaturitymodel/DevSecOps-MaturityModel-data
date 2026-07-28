# Generisches Schreibstil-Profil

Dieses Profil beschreibt den Schreibstil des Autors/Teams unabhängig vom DSOMM-Kontext – als übertragbare Stilvorlage für beliebige Texte (Dokumentation, Readmes, Wikis, Tickets, Richtlinien). Es abstrahiert von Schema und Fachdomäne und erfasst Stimme, Satzbau, Formatierung und Eigenheiten.

## 1. Stimme und Grundhaltung

- **Register:** knapp, sachlich, checklistenartig. Praktiker schreibt für Praktiker; Fachvokabular wird ohne Erklärung vorausgesetzt. Kein Marketing-Ton, keine Füllwörter, keine Höflichkeitsfloskeln.
- **Perspektive:** standardmäßig unpersönliche dritte Person. Direkte Leseransprache („you/your") nur sparsam und eher in Anleitungs- oder Beispielkontexten („Find a tool that suits your environment.").
- **Haltung:** feststellend statt werbend. Zielzustände werden als Fakt formuliert („Findings are visualized per component."), nicht als Versprechen. Meinungen werden trocken und beiläufig eingestreut („There are debates on how useful a WAF is for APIs.").
- **Humor:** selten, trocken, einzeilig, mitten im Sachtext („Security joke: We will gain 100% false negatives."). Gelegentlich narrative Ich-Perspektive zur Veranschaulichung eines Szenarios („As an attacker, I compromise a system, gather credentials and try to use them.").
- **Pragmatismus vor Perfektion:** Texte sind Arbeitsdokumente. Platzhalter (`TODO`), offene Fragen als Kommentar und unfertige Stellen werden sichtbar stehengelassen statt versteckt. Copy-Paste-Wiederverwendung ganzer Absätze über verwandte Texte hinweg ist normal.

## 2. Sprache

- **Englisch, amerikanische Schreibweise** („organization", „behavior", „analyze"). Erkennbar von deutschen Muttersprachlern geschrieben.
- **Zwei Schichten:** älterer Text ist kurz, passivisch und fehlerbehaftet; neuerer Text ist flüssig, aktiv/imperativisch, mit längeren Sätzen und Gedankenstrichen. Neue Texte sollten der neueren Schicht folgen: korrektes, direktes Englisch bei gleichbleibender Knappheit.
- **Hedging als Stilmittel:** Unsicheres wird konsequent mit „might", „can", „may lead to" markiert; Empfehlungen mit „should be considered", „is recommended", „A good practice is to …", „helps to …". Absolute Behauptungen sind selten.
- **Satzbau:**
  - Kurze Aussagesätze im Präsens dominieren; 1–3 Sätze pro Gedanke.
  - Satzfragmente sind als Stilmittel akzeptiert, besonders als nachgestellte Präzisierung („At least quarterly.") oder als Titel-/Listenzeile ohne Verb.
  - Nominalstil bei Benennungen: „Usage of …", „Creation of …", „Definition of …", „Conduction of …".
  - Ursache-Wirkungs-Ketten in zwei Schritten: „X might lead to Y. This might lead to Z."
- **Konkretion:** Abstraktes wird sofort mit Beispielen geerdet – Toolnamen, Kontonamen, Schwellwerte und Zeiträume direkt in der Prosa („Use a tool like trivy", „standard accounts like 'admin'", „in under 10 minutes", „twice in a year for 1-3 days").

## 3. Formatierung und Markdown-Gewohnheiten

- **Bullets:** `-`-Listen als Standardwerkzeug für Aufzählungen, Nachweise und Schritte; kurz, ein Gedanke pro Punkt. Schlusspunkte uneinheitlich (neue Texte: konsequent setzen).
- **Hervorhebung:** Kursiv per `_underscore_` für eingeführte Fachbegriffe („A _defined deployment process_ is …"); **Fett** für Labels und Ankündigungen („**Example High Maturity Scenario:**"); Backticks für Code- und Toolbegriffe; einfache Anführungszeichen für Literale (‚admin', ‚cat').
- **Überschriften:** sparsam, `#`/`###`, oft als knappe Sektionsmarker („### Benefits").
- **Links:** Inline-Markdown-Links mit sprechendem Linktext; Quellenangabe als eigene Zeile am Textende („Source: …" oder „[Source: …](URL)").
- **Definitorischer Einstieg** als wiederkehrendes Muster längerer Texte: erster Satz definiert den Gegenstand („X is / refers to the practice of …"), danach Nutzen, dann Details/Bullets.
- **Kein HTML**, keine Tabellenlastigkeit, keine Deko. Emojis nur als etablierte Insider-Marker (z. B. `:unicorn:` für „Besonderheiten eurer Anwendung"), nicht als Schmuck.

## 4. Wiederkehrende Formulierungsmuster

- Risiko/Problem: Negationseinstieg – „Without …", „Failing to … might undermine …", „Not aware of …"; Folgen mit „might get exploited", „leading to potential … and data loss".
- Maßnahme/Anleitung: Imperativ mit Objekt und Beispiel – „Implement a centralized logging solution for all critical systems.", „Mandate blocking of force pushes …", „Integrate static code analysis tools in IDEs."
- Zustandsbeschreibung: kurzes Passiv – „X is performed.", „Y are tracked in the teams issue system (e.g. jira)."
- Nachweis/Prüfung: „Show …", „Demonstrate …", „… are available".
- Einschränkung/Abgrenzung: „… rather than replacing them", „The human decision stays: …", „Therefore, choose this activity wisely."
- Beispiele fast immer als Klammereinschub mit „e.g." (sehr häufig; neuere Texte mit Komma: „e.g., Dependabot or Renovate"), Aufzählungen offen gelassen mit „…" („mandatory code reviews, ...").

## 5. Terminologie und Abkürzungen

- Abkürzungen bei Ersteinführung ausschreiben und in Klammern abkürzen, danach nur noch die Kurzform: „Mean Time to Resolution (MTTR)", „SBOM (Software Bill of Materials)".
- Eigenwillige, aber konsistente Wortwahl gehört zur Stimme: Angreifer als „evil actors"/„evil administrators"; „unsecure" kommt historisch vor (neu: „insecure").
- Tags/Slugs/Bezeichner: kebab-case, klein, kurz.
- Produktnamen korrekt kapitalisieren (im Altbestand nachlässig: „jenkins", „github" – nicht übernehmen).

## 6. Typische Fehlerquellen des Altbestands (nicht reproduzieren)

Zur Abgrenzung – diese Muster prägen alte Texte, sollen in neuen aber vermieden werden:

- „specially" statt „especially" (systematisch), „the hole organization" (whole), „Two ore more" (or), „might exists"/„shouldn't exists", „alarms are send out", „availabe", „builded".
- Germanismen: Kommasetzung nach deutschem Muster („makes sure, that …"), „are getting + Partizip" („are not getting tracked"), Bindestrich-Komposita („Coverage- and control-metrics"), „as" statt „than" in Vergleichen.
- Halbfertige Sätze, doppelte Wörter („in in", „to to"), verwaiste Satzzeichen und abgebrochene Klammern.

## 7. Kurzrezept

1. Kurz und konkret schreiben: ein Gedanke pro Satz, ein Gedanke pro Bullet; lieber ein Beispiel in Klammern als ein erklärender Absatz.
2. Amerikanisches Englisch, Präsens, aktiv/imperativisch; Passiv nur für Zustandsbeschreibungen.
3. Unsicherheit ehrlich hedgen („might", „can"), Empfehlungen als „should"/„A good practice is to …".
4. Längere Texte mit Definitionssatz beginnen, mit `-`-Bullets strukturieren, mit Quellenzeile enden.
5. Fachbegriffe kursiv einführen, Abkürzungen einmal ausschreiben, Literale in einfache Anführungszeichen.
6. Konkrete Tools, Zahlen und Zeiträume nennen statt Allgemeinplätze.
7. Nüchtern bleiben; Meinung und Humor sparsam und trocken dosieren.
8. Unfertiges als `TODO` markieren statt verschleiern.
