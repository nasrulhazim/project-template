# Contribution Guide

Thank you for considering contributing to **Project Template**! Please take a moment to review this guide to ensure your contributions align with the project's standards and goals.

## Bug Reports

To encourage active collaboration, we strongly encourage bug reports to follow these guidelines:

1. **Search existing issues** before submitting a new one.
2. If the issue does not already exist, create a new issue.
3. Include the following details:
   - A descriptive title.
   - Steps to reproduce the issue.
   - Expected behaviour.
   - Actual behaviour.
   - Environment details (Laravel version, PHP version, etc.).
4. Provide as much context as possible to help maintainers understand the issue.

Issues that do not meet these requirements may be closed without further explanation.

## Support Questions

We do not provide support through the issue tracker. If you have a question, consider asking in:

1. [Laravel.io](https://laravel.io) or
2. [Laravel Malaysia](https://t.me/LaravelMY)

## Core Development Discussion

To propose a significant new feature, start by opening an issue. Please include as much detail as possible, including potential use cases and examples. This ensures maintainers can discuss the feature before significant development is undertaken.

## Contribution Process

We accept contributions in the form of pull requests. To submit a pull request:

1. Fork the repository.
2. Create a branch for your changes:
   ```bash
   git checkout -b feature/your-feature-name
   ```
3. Make your changes in this branch.
4. Ensure your code adheres to the style guide and passes all tests.
5. Submit a pull request to the `main` branch.

## Coding Style

**Project Template** adheres to [PSR-12 coding standards](https://www.php-fig.org/psr/psr-12/) and uses [Laravel’s conventions](https://laravel.com/docs/11.x). To ensure consistency, run the following commands before committing your changes:

- **PHP Formatting**:
  ```bash
  composer format
  ```
- **JavaScript/TypeScript Formatting**:
  ```bash
  npm run lint
  ```

## Running Tests

Before submitting your changes, ensure all tests pass:

1. Run the test suite:
   ```bash
   php artisan test
   ```
2. Add new tests for any new features or bug fixes.

## Security Vulnerabilities

If you discover a security vulnerability in this project, please report it privately by emailing [nasrulhazim.m@gmail.com](mailto:nasrulhazim.m@gmail.com). Security vulnerabilities will be promptly addressed.

---

Thank you for your contributions!
