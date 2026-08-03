
## 1. Functional requirements

The Officer module must manage the full officer lifecycle:

- Officer profile: personal details, photo, contact data, employment status.
- Organization: designation, department, branch, reporting manager.
- Access: module assignments, roles, permissions, active/inactive status.
- Work: targets, tasks, project visits, attendance, commission records.
- Documents: upload, approve, replace, and download officer documents.
- Reporting: individual and branch/department performance, target progress, task completion, attendance, visits, and commissions.
- Auditability: activity logs for profile, assignment, approval, and operational changes.
- Cross-module work attribution for Land Project, Father Shop, Our Flat, E-Shop, Investment, Merchant, Recruitment, Project Visit, Point Store, Agent Registration, and Packages.

## 2. User roles

| Role | Main responsibility |
|---|---|
| Super Admin | Full platform configuration, all modules, access governance |
| HR/Admin | Officer records, organization structure, documents, attendance |
| Officer Manager | Assign officers, targets, tasks, review performance |
| Branch Manager | Manage officers and performance inside assigned branch |
| Department Manager | Manage department-level staff, tasks, and targets |
| Officer | Update profile, attendance, assigned tasks, visits, documents |
| Finance/Commission Officer | Review and approve commission data |
| Auditor/Report Viewer | Read-only reports and activity logs |

Roles should be permission-driven through the existing Spatie Permission package; a role grants a curated permission set, rather than hard-coding access checks.

## 3. Officer workflow

```text
Create Officer
  → Assign designation, department, branch, manager
  → Assign role, permissions, and business modules
  → Upload/verify required documents
  → Activate officer account
  → Assign targets and tasks
  → Officer records attendance, work, visits, and module activities
  → Manager reviews progress and approvals
  → Commission calculation/approval
  → Performance reports and activity audit trail
```

Status lifecycle: `draft → pending_verification → active → suspended → resigned/archived`.

## 4. Database tables and relationships

| Table | Purpose / key relationships |
|---|---|
| `users` | Login identity; one-to-one with `officer_profiles` for officers |
| `officer_profiles` | Officer employment profile; belongs to user, designation, department, branch, manager |
| `designations` | Job titles; has many officer profiles |
| `departments` | Organizational departments; has many officers |
| `branches` | Operating branches; has many officers |
| `officer_branch_assignments` | Officer-to-branch history; supports primary branch and effective dates |
| `officer_module_assignments` | Officer access/scope for each business module |
| `roles`, `permissions`, model pivot tables | Existing Spatie role/permission data |
| `officer_targets` | Period target, metric, source module, value, owner, approver |
| `officer_tasks` | Assigned task, priority, due date, status, source module |
| `officer_task_updates` | Task comments, progress, completion evidence |
| `officer_visits` | Visit schedule, customer/project reference, check-in/out, outcome |
| `attendances` | Daily check-in/out, work mode, branch, approval status |
| `officer_commissions` | Earning source, period, amount, status, approver |
| `officer_documents` | NID, appointment letter, CV, certificates, contracts; storage path and verification |
| `officer_performance_snapshots` | Cached/approved daily, monthly, or quarterly performance totals |
| `activity_log` | Existing Spatie audit log, with officer and module context |
| `module_references` *(optional)* | Normalized cross-module entity reference when source tables differ greatly |

Key relationships:

- `User 1—1 OfficerProfile`
- `OfficerProfile N—1 Department`, `Designation`, `Branch`, and optional `Manager`
- `OfficerProfile N—N Branch` through `officer_branch_assignments`
- `OfficerProfile N—N BusinessModule` through `officer_module_assignments`
- `OfficerProfile 1—N Targets`, `Tasks`, `Visits`, `Attendances`, `Commissions`, `Documents`
- Each target/task/visit/commission can carry `source_module` plus `source_type` / `source_id` for traceability.

## 5. Permission matrix

| Capability | Super Admin | HR/Admin | Manager | Officer | Finance | Auditor |
|---|---:|---:|---:|---:|---:|---:|
| Manage organizational setup | Yes | Limited | No | No | No | View |
| Create/edit officer | Yes | Yes | Assigned scope | Self only | No | View |
| Assign roles/modules | Yes | Limited | Assigned scope | No | No | View |
| Assign targets/tasks | Yes | Yes | Assigned scope | View own | No | View |
| Record attendance/visits | Yes | Yes | Assigned scope | Own only | No | View |
| Manage documents | Yes | Yes | Assigned scope | Own upload | No | View |
| Review commissions | Yes | View | View scope | View own | Yes | View |
| View performance reports | Yes | Scope | Scope | Own | Scope | Yes |
| View activity logs | Yes | Limited | Scope | Own actions | Scope | Yes |

Permission names should be granular, such as `officers.view`, `officers.create`, `officers.update`, `officers.assign-branch`, `officer-targets.assign`, `attendance.approve`, and `commissions.approve`.

## 6. Module integration map

| Integrated module | Officer interaction |
|---|---|
| Land Project | Leads, bookings, site visits, sales targets, commissions |
| Father Shop | Store tasks, sales activity, merchant/customer visits |
| Our Flat | Property leads, bookings, flat visits, sales targets |
| E-Shop | Order/customer handling, sales tasks, commission sources |
| Investment | Investor follow-up, meetings, conversion targets |
| Merchant | Merchant onboarding, account activity, service visits |
| Recruitment | Candidate follow-up, recruiter tasks, placement metrics |
| Project Visit | Visit scheduling, check-in/out, outcomes, follow-ups |
| Point Store | Store performance, outlet visits, order/sales contribution |
| Agent Registration | Agent onboarding, verification, assigned officer ownership |
| Packages | Package sales, renewals, assigned targets, commissions |

Integration principle: each external module owns its business records. The Officer module owns assignment, access, work tracking, performance aggregation, and audit records.

## 7. Laravel folder structure

```text
app/
├── Core/
│   ├── Activity/
│   ├── Authorization/
│   ├── Documents/
│   ├── Organizations/
│   ├── Reporting/
│   ├── Shared/
│   └── Support/
│
└── Modules/
    ├── Officer/
    │   ├── Actions/
    │   ├── Contracts/
    │   ├── Data/
    │   ├── Domain/
    │   │   ├── Models/
    │   │   ├── Policies/
    │   │   └── Enums/
    │   ├── Events/
    │   ├── Http/
    │   │   ├── Controllers/
    │   │   ├── Requests/
    │   │   └── Resources/
    │   ├── Jobs/
    │   ├── Listeners/
    │   ├── Services/
    │   ├── database/
    │   │   ├── factories/
    │   │   ├── migrations/
    │   │   └── seeders/
    │   ├── resources/views/
    │   └── routes/
    ├── LandProject/
    ├── FatherShop/
    ├── OurFlat/
    ├── EShop/
    ├── Investment/
    ├── Merchant/
    ├── Recruitment/
    ├── ProjectVisit/
    ├── PointStore/
    ├── AgentRegistration/
    └── Packages/
```

Shared organization, authorization, document storage, auditing, and reporting capabilities belong in `app/Core`. Each business module owns its domain workflows and emits events consumed by Officer reporting.

## 8. API endpoints

```text
GET    /api/v1/officers
POST   /api/v1/officers
GET    /api/v1/officers/{officer}
PATCH  /api/v1/officers/{officer}

POST   /api/v1/officers/{officer}/branches
POST   /api/v1/officers/{officer}/modules
POST   /api/v1/officers/{officer}/roles
POST   /api/v1/officers/{officer}/documents

GET    /api/v1/officers/{officer}/targets
POST   /api/v1/officers/{officer}/targets
PATCH  /api/v1/officer-targets/{target}

GET    /api/v1/officers/{officer}/tasks
POST   /api/v1/officer-tasks
PATCH  /api/v1/officer-tasks/{task}
POST   /api/v1/officer-tasks/{task}/updates

POST   /api/v1/attendance/check-in
POST   /api/v1/attendance/check-out
GET    /api/v1/attendance
PATCH  /api/v1/attendance/{attendance}/approve

GET    /api/v1/officer-visits
POST   /api/v1/officer-visits
PATCH  /api/v1/officer-visits/{visit}

GET    /api/v1/officer-commissions
POST   /api/v1/officer-commissions
PATCH  /api/v1/officer-commissions/{commission}/approve

GET    /api/v1/reports/officers/performance
GET    /api/v1/reports/officers/targets
GET    /api/v1/reports/officers/attendance
GET    /api/v1/officers/{officer}/activity
```

## 9. Admin panel pages

- Officer dashboard
- Officer directory and profile
- Create/edit officer
- Designations, departments, and branches
- Officer branch and reporting-manager assignments
- Module assignment and access scope
- Role and permission assignment
- Target management
- Task board and task detail
- Attendance register and approval queue
- Visit planner and visit history
- Commission register and approval queue
- Document centre and verification queue
- Activity log viewer
- Performance dashboard and exportable reports

## 10. Development phases

1. Foundation: module loader conventions, Core services, policies, audit events.
2. Organization: departments, designations, branches, officer profile and lifecycle.
3. Access: roles, permissions, module/branch scope assignments.
4. Operations: targets, tasks, attendance, visits, documents.
5. Financial performance: commissions, KPI calculations, performance snapshots.
6. Integrations: event contracts and references for all 11 business modules.
7. Reporting: dashboards, filters, exports, audit views.
8. Quality and rollout: feature tests, permission tests, migration plan, data import, monitoring.