# Architecture of the DSOMM YAML Model

This document describes the structure of the YAML files in `src/assets/YAML/default`,
which define the DSOMM maturity model (dimensions, subdimensions, activities and
implementation hints).

## Processing pipeline

```
src/assets/YAML/default/<Dimension>/<Subdimension>.yaml   (model source, this document)
src/assets/YAML/default/implementations.yaml              (shared tool/reference catalog)
src/assets/YAML/custom/<Dimension>/*.yaml                 (optional org-specific overlay)
        │
        ▼  yaml-generation/generateDimensions.php  (run via generateDimensions.bash, dockerized)
generated/model.yaml                                      (merged model consumed by the application)
```

The generator:

- merges all `src/assets/YAML/default/*/*.yaml` files (skipping `_meta.yaml`),
- overlays `src/assets/YAML/custom/*/*.yaml` if present (when a custom folder exists,
  only activities defined there are kept),
- fails on duplicate `uuid`s and duplicate activity names (both must be globally unique),
- fails on missing `uuid` or `level`,
- resolves `dependsOn` entries (by activity name or uuid) across the *whole* model — cross-dimension dependencies are allowed,
- defaults missing `tags` to `["none"]` and auto-generates an `openCRE` reference,
- sorts activities by level.

## Directory and file structure

Each **dimension** is a directory; each **subdimension** is one YAML file in it.
Inside a file the nesting repeats dimension and subdimension as map keys:

```yaml
# yaml-language-server: $schema=../../schemas/dsomm-schema-<dimension>.json
---
Build and Deployment:        # dimension name (must match across all files in the folder)
  Build:                     # subdimension name (one per file)
    Defined build process:   # activity name (globally unique)
      uuid: ...
      ...
```

| Path | Purpose |
|---|---|
| `default/<Dimension>/_meta.yaml` | Display metadata of the dimension |
| `default/<Dimension>/<Subdimension>.yaml` | Activities of one subdimension |
| `default/implementations.yaml` | Catalog of tools/references, targeted by `$ref` |
| `schemas/dsomm-schema-*.json` | JSON schemas (one per dimension) for editor validation |
| `../meta.yaml` | UI strings, labels for reference systems, level descriptions |
| `../teams.yaml` | Team names and team groups for per-team assessment |

Current dimensions: `AI`, `BuildAndDeployment`, `CultureAndOrganization`,
`Implementation`, `InformationGathering`, `TestAndVerification`.

## `_meta.yaml` attributes

| Attribute | Required | Description |
|---|---|---|
| `_meta.label` | yes | Display name of the dimension (e.g. "Build and Deployment") |
| `_meta.icon` | no | Icon file name; may be empty |
| `_meta.description` | no | Markdown description of the dimension and its subdimensions |

## Activity attributes

"Schema" = required by the JSON schemas in `src/assets/YAML/schemas/`.
"Generator" = hard-enforced by `generateDimensions.php` (build fails without it).
In practice several schema-required attributes are omitted in existing files (see
"Known inconsistencies" below); when creating **new** activities, treat every
schema-required attribute as mandatory.

### Mandatory

| Attribute | Enforced by | Description |
|---|---|---|
| `uuid` | schema + generator | Globally unique, stable identifier (UUID v4). Never reuse or change; used to track assessment state across model updates. |
| `risk` | schema | What can go wrong if the activity is *not* performed. Shown as motivation for the activity. |
| `measure` | schema | What to do: the concrete countermeasure/practice the activity consists of. |
| `level` | schema + generator | Maturity level 1–5 at which the activity is expected. |
| `difficultyOfImplementation` | schema | Effort estimate object with three sub-attributes, each rated 1–5: `knowledge` (required expertise; disciplines involved), `time` (effort over time), `resources` (systems/licenses needed). All three are required. |
| `usefulness` | schema | Security benefit of the activity, rated 1–5. |
| `implementation` | schema | List of `- $ref: src/assets/YAML/default/implementations.yaml#/implementations/<key>` pointers to tools/guides that help implement the activity. May be an empty list (`[]`). Only `$ref` entries are allowed. |
| `references` | schema | Mappings to other standards. `samm2` (OWASP SAMM v2 stream IDs), `iso27001-2017` and `iso27001-2022` (control numbers) are required arrays; free-text entries are used to note missing mappings. `openCRE` is added automatically by the generator — do not maintain it manually. Other standards (e.g. OWASP AISVS categories) are linked as `implementation` `$ref`s (entries `aisvs-c01` … `aisvs-appc` in `implementations.yaml`), not as reference arrays. |
| `description` | schema | Markdown long-form explanation of the activity (background, benefits, guidelines). Required by schema, though older activities often omit it. |
| `comments` | schema¹ | Assessment comments placeholder, initialize with `""`. |

¹ Optional in `dsomm-schema-test-and-verification.json` and `dsomm-schema-agentic-ai.json`;
required by the other dimension schemas.

The former assessment-state attributes `isImplemented` and `evidence` have been
removed from the schemas and from all activity YAML files; assessment state is
not maintained in the model source.

### Optional

| Attribute | Description |
|---|---|
| `assessment` | Markdown checklist describing how an assessor verifies the activity (what to show/demonstrate). |
| `dependsOn` | List of activity *uuids* that should be implemented first, with the activity name appended as a YAML comment for readability (`- <uuid> # <name>`). Resolved globally, so activities in other dimensions can be referenced. The generator also resolves plain activity names (used in older files) and fails on unknown references. |
| `tags` | List of free-form tags used for filtering in the UI (e.g. `inventory`, `sca`, `ai`). Defaults to `["none"]`. |
| `meta.implementationGuide` | Practical how-to hints for implementing the measure. |
| `credits` | Attribution when an activity was adopted from another project (e.g. AppSecure-nrw Security Belts). |
| `teamsImplemented`, `teamsEvidence` | Per-team assessment state (used in team mode; see `dsomm-schema-implementation.json` and `teams.yaml`). |

YAML anchors/aliases (`&name` / `*name`) are used in existing files to share
identical `risk` texts between activities and are safe to use.

## `implementations.yaml` attributes

Every entry under the top-level `implementations:` key:

| Attribute | Required | Description |
|---|---|---|
| `uuid` | yes | Unique identifier of the implementation |
| `name` | yes | Display name of the tool/resource |
| `tags` | yes | List of tags (may be empty `[]`) for filtering |
| `url` | yes (schema) | Link to the tool/resource; omitted in a few legacy entries |
| `description` | yes (schema) | Short markdown description; omitted in many legacy entries |

Activities reference these entries via `$ref`, so a tool is described once and
reused everywhere. `TEST_REFERENCED_URLS=true` (or `generateDimensions.bash --test-urls`)
checks all URLs.

## Known inconsistencies

- The JSON schemas declare `additionalProperties: false` but existing files use
  attributes not present in every schema (`tags`, `credits`, `comment`); the
  generator accepts them.
- Schema-required attributes (`description`, `comments`) are missing in many
  existing activities; only `uuid` and `level` make the generator fail.
- The per-dimension schemas differ slightly (`dsomm-schema-test-and-verification.json`
  requires fewer attributes; `dsomm-schema-implementation.json` uses
  `teamsImplemented`/`teamsEvidence`).

## The Agentic AI dimension

The `Agentic AI` dimension (`src/assets/YAML/default/AgenticAI/`, schema
`schemas/dsomm-schema-agentic-ai.json`) covers the secure use of AI in software
development and the security of AI-based features:

| Subdimension | Activity | Level |
|---|---|---|
| Isolation | Usage of sandboxing for AI agents | 1 |
| Isolation | Permission management for AI agents | 1 |
| Isolation | Least privilege on external systems for AI agents | 2 |
| Isolation | Untrusted workspace handling for AI agents | 2 |
| Isolation | Network isolation for AI agents | 3 |
| Guidance | Basic secure coding rules for AI assistants | 1 |
| Guidance | AI usage policy | 2 |
| Guidance | Security requirements for AI-assisted development | 2 |
| Guidance | Spec-driven development | 2 |
| Guidance | Inventory of AI agents | 2 |
| Guidance | Language and framework specific secure coding rules for AI assistants | 3 |
| Guidance | Evaluation of the trust of used AI components | 3 |
| Verification | Continuous detection of compromised AI components | 4 |
| Guidance | Threat modeling of AI components | 3 |
| Guidance | Loading security rules at the right development step | 4 |
| Data Protection | Basic data leak prevention | 1 |
| Data Protection | Input validation for AI systems | 2 |
| Data Protection | Secure output handling in AI applications | 4 |
| Data Protection | Protection of agent memory against poisoning | 3 |
| Data Protection | Automated data leak detection for AI interactions | 4 |
| Data Protection | Hallucination detection for AI responses | 4 |
| Verification | Human review of AI generated code | 1 |
| Verification | Validation of AI-suggested dependencies | 2 |
| Verification | Self-verification of AI generated changes | 2 |
| Verification | No verification bypass for AI generated code | 2 |
| Verification | Static and dynamic analysis of AI generated code | 3 |
| Verification | Security test generation with AI | 3 |

All Agentic AI activities carry the tag `ai` plus a subdimension tag
(`isolation`, `guidance`, `data-protection`, `verification`).

## Handling duplicates (e.g. SAST/DAST for AI-generated code)

AI-generated code must be verified with SAST/DAST — but static and dynamic
analysis are already covered by the *Test and Verification* dimension
(`StaticDepthForApplications`, `DynamicDepthForApplications`, …). Copying those
activities into the Agentic AI dimension would break the model: the generator rejects
duplicate uuids and duplicate activity names, and a copy would fork the
assessment state (an organization would have to answer the same question twice).

The proposed rules, applied in the Agentic AI dimension:

1. **One canonical activity per topic.** A practice lives in exactly one
   dimension/subdimension. SAST/DAST stay in *Test and Verification*.
2. **Reference, don't copy — use `dependsOn`.** `dependsOn` resolves activity
   names across the whole model. The AI activity
   *"No verification bypass for AI generated code"* depends on
   `Defined build process`, `Static analysis for important server side components`
   and `Simple Scan` instead of redefining them. The AI activity itself only
   describes the **delta**: making sure AI-generated changes cannot skip those
   existing gates.
3. **Use `tags` for cross-cutting views.** Tagging existing canonical activities
   with `ai` (e.g. the SAST/DAST/SCA activities most relevant for AI-generated
   code) allows filtering an "AI security" view in the UI without duplicating
   content or uuids.
4. **Only create a new activity for a genuine delta.** If AI introduces a new
   aspect of an existing topic, create a new activity with its own uuid that is
   scoped to that aspect (e.g. *"Human review of AI generated code"* — review
   accountability and no self-approving agents), and link the generic activity
   via `dependsOn`.
5. **Mention the relationship in `description`.** The activity text should state
   explicitly that the generic practice is defined elsewhere, so readers and
   assessors are not confused about scope.
