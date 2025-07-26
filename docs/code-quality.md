# 🛠 PHPStan Identifier Extractor

This script runs [PHPStan](https://phpstan.org/) with JSON output and extracts error identifiers into separate `.txt` files for easy filtering and review.

Each output file is named after the **`identifier`** (e.g. `assign.propertyType.txt`) and includes detailed error messages and file context.

## 📦 Features

* Runs PHPStan with `--error-format=json`
* Cleans up old `.txt` outputs before each run
* Groups errors by `identifier` into individual text files
* Formats output for readability
* Automatically skips if no issues are found

## 📁 Output Example

A file like `.phpstan/assign.propertyType.txt` will look like this:

```plaintext
------ ----------------------------------------------------------------------------------------------------------------------
 Line   /path/to/SelectionController.php
------ ----------------------------------------------------------------------------------------------------------------------
 166     Property App\Models\Applicant::$is_generate (int) does not accept true.
------ ----------------------------------------------------------------------------------------------------------------------

------ ----------------------------------------------------------------------------------------------------------------------
 Line   /path/to/SelectionController.php
------ ----------------------------------------------------------------------------------------------------------------------
 222     Property App\Models\Applicant::$is_generate (int) does not accept false.
------ ----------------------------------------------------------------------------------------------------------------------
```

## 🚀 Usage

### Ensure `jq` is installed

```bash
sudo apt install jq      # Debian/Ubuntu
brew install jq          # macOS
```

```bash
chmod +x phpstan-scan.sh
```

### Run the script

```bash
bin/phpstan
```

### Review the output

Each identifier will have its own `.txt` file inside the `.phpstan/` folder.

## 🧼 Cleanup

Old `.txt` files are deleted on every run to avoid mixing results from different scans.

## 📂 Directory Structure

```plaintext
.project-root/
├── .phpstan/
│   ├── assign.propertyType.txt
│   ├── larastan.relationExistence.txt
│   └── scan-result.json
├── bin/
│   └── phpstan
└── vendor/
```

## 📌 Notes

* Requires PHPStan to be installed locally in `vendor/bin/phpstan`
* Only processes messages that contain an `identifier`
* Skips empty or invalid results automatically
