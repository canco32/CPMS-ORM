
BEGIN;

-----------------------------------------------------------------------
-- department
-----------------------------------------------------------------------

DROP TABLE IF EXISTS "department" CASCADE;

CREATE TABLE "department"
(
    "department_id" serial NOT NULL,
    "department_name" VARCHAR NOT NULL,
    PRIMARY KEY ("department_id")
);

-----------------------------------------------------------------------
-- employees
-----------------------------------------------------------------------

DROP TABLE IF EXISTS "employees" CASCADE;

CREATE TABLE "employees"
(
    "employee_id" serial NOT NULL,
    "employee_name" VARCHAR NOT NULL,
    "employee_position" VARCHAR NOT NULL,
    "employee_department" INTEGER NOT NULL,
    "employee_salary" VARCHAR NOT NULL,
    PRIMARY KEY ("employee_id")
);

-----------------------------------------------------------------------
-- project
-----------------------------------------------------------------------

DROP TABLE IF EXISTS "project" CASCADE;

CREATE TABLE "project"
(
    "project_id" serial NOT NULL,
    "project_name" VARCHAR NOT NULL,
    "project_department" INTEGER NOT NULL,
    PRIMARY KEY ("project_id")
);

-----------------------------------------------------------------------
-- tasks
-----------------------------------------------------------------------

DROP TABLE IF EXISTS "tasks" CASCADE;

CREATE TABLE "tasks"
(
    "task_id" serial NOT NULL,
    "task_name" VARCHAR NOT NULL,
    "task_project" INTEGER NOT NULL,
    "task_employee" INTEGER NOT NULL,
    "task_date" TIMESTAMP NOT NULL,
    "task_deadline" TIMESTAMP NOT NULL,
    PRIMARY KEY ("task_id")
);

ALTER TABLE "employees" ADD CONSTRAINT "employees_employee_department_fkey"
    FOREIGN KEY ("employee_department")
    REFERENCES "department" ("department_id");

ALTER TABLE "project" ADD CONSTRAINT "project_project_department_fkey"
    FOREIGN KEY ("project_department")
    REFERENCES "department" ("department_id");

ALTER TABLE "tasks" ADD CONSTRAINT "tasks_task_employee_fkey"
    FOREIGN KEY ("task_employee")
    REFERENCES "employees" ("employee_id");

ALTER TABLE "tasks" ADD CONSTRAINT "tasks_task_project_fkey"
    FOREIGN KEY ("task_project")
    REFERENCES "project" ("project_id");

COMMIT;
