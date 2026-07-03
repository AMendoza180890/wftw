# WFTW — Agent Orchestrator Prompt

Use this document as the **single source of truth** when launching an orchestrator agent to remediate the **WFTW (Wheels for the World)** project. The orchestrator coordinates implementation subagents, a code-review subagent, and a validation/testing subagent across staged deliverables.

---

## 1. Orchestrator Mission

You are the **Orchestrator Agent** for the repository at:

```
c:\xampp\htdocs\wftw
```

**Primary goal:** Fix all critical security issues, broken features, and dependency inconsistencies identified in the code review — in **stages**, with **review** and **tests** after each stage before proceeding.

**Secondary goal:** Align the project with its README (Composer, `.env`, schema) without unnecessary UI rewrites in early stages.

**You must NOT:**
- Skip security fixes to rush features
- Merge a stage without code-review subagent sign-off
- Merge a stage without validation subagent passing tests for that stage
- Commit secrets (`.env`, credentials, SQL dumps with real passwords)
- Force-push to `main` unless explicitly requested
- Rewrite AdminLTE 2 / Bootstrap 3 UI until Stage 4

---

## 2. Project Context

### What this app does
PHP MVC admin system for **Wheels for the World** event registration:
- Manage beneficiaries (create, edit, deactivate, mark as attended)
- Manage admin users and roles
- Generate beneficiary PDF reports (dompdf)
- Dashboard with user counts

### Stack (current)
| Layer | Technology | Notes |
|-------|------------|-------|
| Backend | PHP 7.4+ (target 8.1+) | XAMPP / Apache |
| Database | MySQL 5.7+ | PDO prepared statements |
| Routing | `.htaccess` → `index.php?ruta=` | Whitelist in `rutasAdmin.php` |
| Autoload | Composer PSR-4 | `vendor/` gitignored — must run `composer install` |
| PDF | dompdf ^1.2 (Composer) + **duplicate vendored copy** in `app/controlador/dompdf/` | Broken in report file |
| Frontend | AdminLTE 2, Bootstrap 3, jQuery, Bower (committed), DataTables 1.10.24 CDN | Do not migrate in Stages 0–3 |

### Entry point & structure
```
wftw/
├── index.php                          # Entry: vendor/autoload + plantillaC
├── .htaccess                          # RewriteRule ^([a-zA-Z]+)$ index.php?ruta=$1
├── composer.json                      # dompdf ^1.2, PSR-4 app\
├── .gitignore                         # Only /vendor/ today — needs expansion
├── app/
│   ├── Ajax/
│   │   ├── usuarioA.php               # NO auth — returns user+password JSON
│   │   └── beneficiarioA.php          # NO auth — returns beneficiary PII
│   ├── controlador/
│   │   ├── plantillaC.php
│   │   ├── usuariosC.php
│   │   ├── beneficiariosC.php
│   │   ├── reporteBeneficiario.php    # BROKEN syntax + no auth
│   │   ├── tratamientoImagen.php
│   │   ├── tratamientoRecursos.php
│   │   ├── homeC.php
│   │   ├── rolesC.php
│   │   └── dompdf/                    # DELETE after Stage 2 — duplicate of Composer
│   ├── modelo/
│   │   ├── conexionBD.php
│   │   ├── envConexion.php            # HARDCODED DB credentials — CRITICAL
│   │   ├── usuariosM.php
│   │   ├── beneficiariosM.php
│   │   ├── rolesM.php
│   │   └── homeM.php
│   ├── vista/
│   │   ├── plantilla.php              # Session, routing, layout
│   │   ├── js/usuario.js
│   │   ├── js/beneficiario.js
│   │   └── modulos/                   # Views + inline controller calls
│   └── bkdatabase/*.sql               # Plaintext passwords in repo — REMOVE/SANITIZE
```

### Allowed routes (`app/vista/modulos/rutasAdmin.php`)
`inicio`, `catusuarios`, `login`, `salir`, `catbeneficiario`, `catbeneficiarioBaja`, `catbeneficiarioAtendido`, `showbeneficiarioInfo`, `editbeneficiario`, `crearbeneficiario`, `reporteBeneficiario`

Note: `reporteBeneficiario` is whitelisted but **no** `modulos/reporteBeneficiario.php` exists; PDF is opened directly at `app/controlador/reporteBeneficiario.php`.

---

## 3. Known Issues (Code Review Inventory)

Prioritize fixes in this order:

### Critical
1. **Hardcoded DB credentials** in `app/modelo/envConexion.php` (+ commented production creds)
2. **SQL dumps with plaintext passwords** in `app/bkdatabase/`
3. **Plaintext password auth** — SQL compares `clave` directly; passwords shown in UI and AJAX
4. **Unauthenticated endpoints** — `app/Ajax/*.php`, `app/controlador/reporteBeneficiario.php` (IDOR)
5. **Broken PDF** — `reporteBeneficiario.php` parse error (`</html>';`), no `ob_start()`, wrong dompdf path

### High
6. **CSRF / GET mutations** — deactivate user/beneficiary, activate, mark attended via GET
7. **Wrong “Atendidos” query** — missing `fechaAtendidos IS NOT NULL` in `beneficiariosM.php`
8. **Edit form data loss** — `beneficiario.js` sets placeholder `<option>` ids without `value`
9. **No authorization** beyond login (any logged-in user accesses everything)

### Medium
10. **Routing bug** — logged-in user without `?ruta=` sees login inside wrapper; unclosed `</div>`
11. **XSS** — no `htmlspecialchars()` on echoed DB values
12. **Weak file uploads** — trusts `$_FILES['type']`, no size limit
13. **README mismatch** — references `.env.example`, `database/schema.sql` (don't exist)
14. **Debug/dead code** — `var_dump` in `usuariosM.php`, typo redirect `catusuario`, wrong table column label

### Low
15. Password stored in `$_SESSION["clave"]`
16. Errors echoed to browser
17. Duplicate dompdf + unused AdminLTE demo scripts

---

## 4. Staged Execution Plan

Execute **one stage at a time**. After each stage: run **Code-Review Subagent** → run **Validation Subagent** → only then start next stage.

---

### Stage 0 — Emergency & Bootstrap (Day 1)

**Implement:**
- [ ] Expand `.gitignore` (`.env`, uploads, local config)
- [ ] Add `.env.example` with `DB_HOST`, `DB_NAME`, `DB_USER`, `DB_PASS`, `APP_ENV`
- [ ] Add `vlucas/phpdotenv` via Composer; load in `index.php`
- [ ] Refactor `envConexion.php` to read from environment (no secrets in git)
- [ ] Remove or sanitize `app/bkdatabase/*.sql` (schema-only, no user INSERTs with passwords)
- [ ] Run `composer install`; verify app boots

**Dependencies:**
```json
"require": {
  "php": ">=7.4",
  "vlucas/phpdotenv": "^5.6",
  "dompdf/dompdf": "^1.2"
}
```

**Exit criteria:** App runs locally with `.env`; no secrets in tracked files.

---

### Stage 1 — Security Core (Days 2–5)

**Implement:**
- [ ] `password_hash()` / `password_verify()` + migrate plaintext on login
- [ ] Remove password from UI, AJAX JSON, session
- [ ] Central auth helper: `requireLogin()`, `requireRole([1])`
- [ ] Protect all `app/Ajax/*.php` and PDF report with session + role checks
- [ ] CSRF tokens on all forms; convert GET mutations to POST
- [ ] Update `usuario.js` / `beneficiario.js` for POST + CSRF
- [ ] HTML escape helper `e()` used in all controller echo output
- [ ] Harden uploads: `finfo` MIME, size limit (~2MB), re-encode via GD
- [ ] Session hardening: httponly, samesite, regenerate on login

**Exit criteria:** Unauthenticated Ajax/PDF returns 401/403; no passwords visible; CSRF enforced.

---

### Stage 2 — Broken Features & Data Integrity (Days 6–10)

**Implement:**
- [ ] Rewrite `reporteBeneficiario.php` (ob_start, Composer dompdf, auth)
- [ ] **Delete** entire `app/controlador/dompdf/` vendored folder
- [ ] Fix atendidos query: add `AND fechaAtendidos IS NOT NULL`
- [ ] Fix `beneficiario.js` select population (set parent `<select>.val()`)
- [ ] Fix `plantilla.php` routing (no login when authenticated; close wrapper)
- [ ] Fix redirect typo `catusuario` → `catusuarios`
- [ ] Remove `var_dump` from `usuariosM.php`
- [ ] Fix table header vs data (Cedula/celular)
- [ ] Guard `beneficiarioA.php` — only run when `isset($_POST['id'])`
- [ ] Standardize Ajax bootstrap: `vendor/autoload.php` + auth

**Exit criteria:** PDF downloads for attended beneficiary; atendidos list correct; edit saves preserve dropdowns.

---

### Stage 3 — PHP & Composer Modernization (Days 11–14)

**Implement:**
- [ ] Target PHP 8.1+; fix deprecations (`exception` → `Exception`, etc.)
- [ ] Upgrade `dompdf/dompdf` to `^2.0`; update PDF code if API changed
- [ ] Clean `composer.json` autoload (single `"app\\": "app/"`)
- [ ] Optional: `monolog/monolog` for logging instead of `echo $ex`
- [ ] Commit updated `composer.lock`

**Exit criteria:** App runs on PHP 8.1+; PDF still works on dompdf 2.x.

---

### Stage 4 — Frontend Dependencies (Optional, Week 3+)

**Implement (minimal path):**
- [ ] Audit scripts actually used in `plantilla.php`
- [ ] Upgrade DataTables 1.10.24 → 2.x
- [ ] Remove unused bower components; pin jQuery 3.7.x
- [ ] Remove `demo.js`, `dashboard.js` from production
- [ ] Add SRI to CDN tags

**Defer:** AdminLTE 2 → 3 migration unless explicitly requested.

---

### Stage 5 — Tests, CI & Docs (Days 15–19)

**Implement:**
- [ ] Add PHPUnit `^9.6` (dev)
- [ ] Create `tests/` with smoke/unit tests (see Section 6)
- [ ] Add `.github/workflows/ci.yml`
- [ ] Create `database/schema.sql` (sanitized)
- [ ] Update README to match real setup
- [ ] Block direct web access to `app/modelo/`, `app/bkdatabase/` via `.htaccess`

**Exit criteria:** CI green; README accurate; core flows tested.

---

## 5. Subagent Definitions

The orchestrator **spawns, sequences, and synthesizes** these subagents.

---

### 5.1 Implementation Subagent (per stage)

**When to spawn:** At the start of each stage (0–5).

**Prompt template:**
```
You are an Implementation Subagent for WFTW Stage {N}.

Repository: c:\xampp\htdocs\wftw
Stage goal: {paste stage goal and task checklist from prompt.md Section 4}

Rules:
- Minimize scope — only change files required for this stage
- Match existing PHP MVC conventions (modelo/controlador/vista)
- Do not commit .env or secrets
- Do not skip auth/CSRF if implementing Stage 1+
- After changes, list every file modified and why

Deliverables:
1. All code changes for Stage {N}
2. Short changelog (what/why)
3. Manual test steps for Validation Subagent
4. Known limitations or follow-ups for next stage

Read prompt.md Sections 2–4 for full context before coding.
```

---

### 5.2 Code-Review Subagent

**When to spawn:** After Implementation Subagent completes a stage, **before** Validation Subagent.

**Prompt:**
```
You are the Code-Review Subagent for WFTW.

Repository: c:\xampp\htdocs\wftw
Review scope: All changes introduced in Stage {N} (use git diff against pre-stage baseline).

Review mindset — report findings ordered by severity:
1. Bugs & behavioral regressions
2. Security issues (auth, CSRF, SQLi, XSS, IDOR, secrets, uploads)
3. Missing error handling
4. Code quality / convention drift
5. Missing tests for new behavior

Context — this project had these known issues (verify they are fixed or not reintroduced):
- Hardcoded credentials in envConexion.php
- Plaintext passwords in DB/UI/AJAX/session
- Unauthenticated Ajax (usuarioA.php, beneficiarioA.php) and PDF report
- Broken reporteBeneficiario.php
- GET-based mutations without CSRF
- Wrong beneficiarios atendidos SQL query
- beneficiario.js edit form select data loss
- plantilla.php routing bug when logged in without ruta
- XSS from unescaped echo in controllers
- Weak file upload validation

Checklist for Stage {N}:
{paste stage exit criteria from prompt.md Section 4}

Output format:
## Summary
(one paragraph)

## Findings
### Critical / High / Medium / Low
- [SEVERITY] file:line — issue — suggested fix

## Stage {N} exit criteria status
- [ ] criterion 1 — PASS/FAIL
- [ ] criterion 2 — PASS/FAIL

## Verdict
APPROVE | APPROVE WITH NOTES | BLOCK — must fix before Validation Subagent runs

Do NOT make code changes unless verdict is BLOCK and user explicitly asked to fix.
```

**Orchestrator rule:** If verdict is **BLOCK**, send findings back to Implementation Subagent; re-run Code-Review Subagent after fixes.

---

### 5.3 Validation & Testing Subagent

**When to spawn:** After Code-Review Subagent returns **APPROVE** or **APPROVE WITH NOTES**.

**Prompt:**
```
You are the Validation & Testing Subagent for WFTW Stage {N}.

Repository: c:\xampp\htdocs\wftw
Environment: XAMPP on Windows (PHP via c:\xampp\php\php.exe if not in PATH)

Your job:
1. Run automated tests (PHPUnit when available from Stage 5 onward)
2. Run stage-specific manual/integration checks
3. Report PASS/FAIL with evidence (command output, HTTP status, screenshots description)

Setup before testing:
- composer install
- Copy .env.example → .env with local test DB credentials
- Import database/schema.sql (or sanitized schema)
- Ensure Apache mod_rewrite enabled; base URL http://localhost/wftw

Stage {N} validation checklist:
{paste stage-specific tests from Section 6 below}

For Stages 0–4 (before full PHPUnit suite):
- Create minimal tests in tests/ if missing and stage requires regression coverage
- Run php -l on all modified PHP files
- Execute manual HTTP/curl checks where applicable

Output format:
## Environment
(PHP version, composer packages, DB connected Y/N)

## Automated tests
| Test | Result | Notes |

## Manual checks
| Check | Result | Steps performed |

## Regressions found
(list any broken existing behavior)

## Verdict
PASS — stage complete | FAIL — return to Implementation Subagent with repro steps

If FAIL: provide exact reproduction steps and expected vs actual behavior.
```

**Orchestrator rule:** If **FAIL**, loop Implementation → Code-Review → Validation until **PASS**.

---

## 6. Test Matrix (Validation Subagent)

### Stage 0 tests
| ID | Check | Expected |
|----|-------|----------|
| S0-1 | `composer install` | Exit 0, `vendor/autoload.php` exists |
| S0-2 | `GET /wftw/` or `/wftw/inicio` | Page loads (login or redirect) |
| S0-3 | Grep tracked files for old DB password strings | No matches |
| S0-4 | `.env` not in git status | Untracked/ignored |

### Stage 1 tests
| ID | Check | Expected |
|----|-------|----------|
| S1-1 | Login with valid admin | Session created; redirect to inicio |
| S1-2 | Login with wrong password | Rejected |
| S1-3 | `POST app/Ajax/usuarioA.php` without session | 401/403 |
| S1-4 | `GET app/controlador/reporteBeneficiario.php?codValor=1` without session | 401/403 |
| S1-5 | User list HTML | No password column values visible |
| S1-6 | AJAX edit user response JSON | No `clave` field |
| S1-7 | Deactivate beneficiary via old GET URL without CSRF | Rejected |
| S1-8 | Deactivate with valid POST + CSRF | Success |
| S1-9 | Submit form with `<script>alert(1)</script>` in name | Escaped in output |

**PHPUnit targets (add in Stage 1 or 5):**
- `tests/Auth/PasswordHashTest.php` — hash/verify roundtrip
- `tests/Auth/CsrfTest.php` — token validation
- `tests/Security/AjaxAuthTest.php` — unauthenticated blocked

### Stage 2 tests
| ID | Check | Expected |
|----|-------|----------|
| S2-1 | Mark beneficiary attended (authenticated) | PDF opens/downloads |
| S2-2 | `reporteBeneficiario.php` PHP syntax | `php -l` passes |
| S2-3 | Atendidos list | Only records with `fechaAtendidos` set |
| S2-4 | Edit beneficiary — save without changing selects | tipoMedio, diagnostico, etc. preserved |
| S2-5 | Logged-in visit to `index.php` (no ruta) | Redirect to inicio, not login |
| S2-6 | Vendored dompdf folder | Deleted; only Composer vendor used |

**PHPUnit targets:**
- `tests/Model/BeneficiariosAtendidosQueryTest.php`
- `tests/Report/ReporteBeneficiarioTest.php` — auth required, valid PDF response headers

### Stage 3 tests
| ID | Check | Expected |
|----|-------|----------|
| S3-1 | PHP version | >= 8.1 |
| S3-2 | `composer update` | No conflicts |
| S3-3 | Full S2 regression suite | All pass |
| S3-4 | PDF generation on dompdf 2.x | Valid PDF bytes |

### Stage 5 tests (full suite)
| ID | Check | Expected |
|----|-------|----------|
| S5-1 | `vendor/bin/phpunit` | All tests green |
| S5-2 | GitHub Actions CI | Passes on push |
| S5-3 | README install steps | Fresh clone + follow steps = working app |

---

## 7. Orchestrator Workflow

```mermaid
flowchart TD
    START([Start Stage N]) --> IMPL[Implementation Subagent]
    IMPL --> REV[Code-Review Subagent]
    REV --> V{Verdict?}
    V -->|BLOCK| IMPL
    V -->|APPROVE| VAL[Validation Subagent]
    VAL --> R{PASS?}
    R -->|FAIL| IMPL
    R -->|PASS| NEXT{Stage N < 5?}
    NEXT -->|Yes| START
    NEXT -->|No| DONE([Project remediated])
```

### Orchestrator session checklist
1. Read this entire `prompt.md`
2. Run `git status` and `git log -5` for baseline
3. Confirm PHP path: `c:\xampp\php\php.exe` (adjust if needed)
4. For each stage 0→5:
   - Spawn **Implementation Subagent** with stage prompt (Section 5.1)
   - Spawn **Code-Review Subagent** on diff (Section 5.2)
   - If blocked → fix loop
   - Spawn **Validation Subagent** (Section 5.3 + Section 6 matrix)
   - If fail → fix loop
   - Summarize stage completion to user (files changed, tests passed, remaining debt)
5. After Stage 5: produce final report comparing code review inventory (Section 3) — item by item FIXED/DEFERRED

### Git conventions
- One branch per stage: `fix/stage-{N}-{short-name}`
- Commit only when user requests or stage is complete and validated
- Commit message style: `fix:`, `chore:`, `security:` prefixes; focus on why

---

## 8. Key Code References (for subagents)

### Broken PDF (must rewrite)
File: `app/controlador/reporteBeneficiario.php`
- Line 42: stray `</html>';` causes parse error
- Missing `ob_start()` before `ob_get_clean()`
- Uses `dompdf/autoload.inc.php` instead of Composer
- No session check

### Auth flow
- Login form: `app/vista/modulos/login.php` → `usuariosC::ingresoUsuariosC()`
- Model query: `usuariosM::ingresoSesionUsuario()` — plaintext SQL match
- Session gate: `app/vista/plantilla.php` — `$_SESSION["ingreso"] == true`

### Vulnerable Ajax
- `app/Ajax/usuarioA.php` — returns full user row including `clave`
- `app/Ajax/beneficiarioA.php` — always runs even without POST id

### Wrong SQL (atendidos)
File: `app/modelo/beneficiariosM.php` → `mostrarListaBeneficiarioAtendidosM()`
```sql
-- Current (wrong):
WHERE fechaBaja IS NULL
-- Required:
WHERE fechaBaja IS NULL AND fechaAtendidos IS NOT NULL
```

### GET mutations (convert to POST)
- `app/vista/js/usuario.js` — `DesactivarRegistroUsuario`
- `app/vista/js/beneficiario.js` — desactivar, activar, atendido

---

## 9. Success Definition

The orchestrator mission is **complete** when:

- [ ] All Critical and High items in Section 3 are **FIXED**
- [ ] All Stage 0–5 exit criteria are **PASS**
- [ ] Code-Review Subagent has **APPROVED** each stage
- [ ] Validation Subagent **PASS** on full regression matrix
- [ ] PHPUnit CI green on `main`
- [ ] README matches implementation
- [ ] No secrets in repository

---

## 10. Quick-Start Command (Orchestrator)

Copy this to start the orchestrator agent:

```
You are the WFTW Orchestrator Agent.

Read and follow c:\xampp\htdocs\wftw\prompt.md in full.

Begin with Stage 0. For each stage:
1. Spawn Implementation Subagent (use prompt template Section 5.1)
2. Spawn Code-Review Subagent on the diff (Section 5.2)
3. If APPROVE, spawn Validation Subagent (Sections 5.3 + 6)
4. Loop until stage PASS, then proceed to next stage

Report progress after each stage. Do not skip review or validation.
Do not commit unless I ask. Use c:\xampp\php\php.exe for PHP commands if php is not in PATH.

Start now with Stage 0 — Emergency & Bootstrap.
```

---

*Generated from WFTW code review and staged remediation plan. Update this file if scope changes.*
