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

### 📄 Sample Summary Output

Here’s an example of what you’ll get in `.phpstan/summary.txt`:

```
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
🔎 PHPStan Scan Summary
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
- Unique Identifiers                          :    1
- Issues Found                                :  468
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
📋 Issues by Identifier:
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
- property.notFound                           :  468
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
```

### 🧩 Sample Issue Breakdown

For every unique issue identifier (e.g., `property.notFound`), you get a dedicated `.txt` file like:

`.phpstan/property.notFound.txt`

With formatted entries:

```
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
📂 File       : /app/Http/Controllers/Admin/LetterTemplates/GeneratePdfController.php
🔢 Line       : 90
💬 Message    : Access to an undefined property App\Models\ApplicantProgramme::$name.
💡 Tip        : Learn more: https://phpstan.org/blog/solving-phpstan-access-to-undefined-property
✅ Ignorable  : Yes
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
```

## 🚀 Usage

### Ensure `jq` is installed

```bash
sudo apt install jq      # Debian/Ubuntu
brew install jq          # macOS
```

For Windows, use [Chocolatey](https://chocolatey.org/) or download manually from [https://stedolan.github.io/jq/download/](https://stedolan.github.io/jq/download/).

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
│   ├── property.notFound.txt
│   ├── summary.txt
│   └── scan-result.json
├── bin/
│   └── phpstan
└── vendor/
```

## 📌 Notes

* Requires PHPStan to be installed locally in `vendor/bin/phpstan`
* Only processes messages that contain an `identifier`
* Skips empty or invalid results automatically
