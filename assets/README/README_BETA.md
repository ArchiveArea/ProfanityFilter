## General

<img id="top" src="assets/images/swearing.png" height="70" width="70" align="left"></img>

[![State](https://poggit.pmmp.io/shield.state/ProfanityFilter)](https://poggit.pmmp.io/p/ProfanityFilter)
[![API](https://poggit.pmmp.io/shield.api/ProfanityFilter)](https://poggit.pmmp.io/p/ProfanityFilter)
[![Downloads Total](https://poggit.pmmp.io/shield.dl.total/ProfanityFilter)](https://poggit.pmmp.io/p/ProfanityFilter)
[![Downloads](https://poggit.pmmp.io/shield.dl/ProfanityFilter)](https://poggit.pmmp.io/p/ProfanityFilter)
[![Lint](https://poggit.pmmp.io/ci.shield/nhanaz-pm-pl/ProfanityFilter/ProfanityFilter)](https://poggit.pmmp.io/ci/nhanaz-pm-pl/ProfanityFilter/ProfanityFilter)

<details> <summary> Other badges </summary>

[![License](https://img.shields.io/github/license/nhanaz-pm-pl/ProfanityFilter)](https://img.shields.io/github/license/nhanaz-pm-pl/ProfanityFilter)
[![CI](https://github.com/nhanaz-pm-pl/ProfanityFilter/actions/workflows/phpstan.yml/badge.svg)](https://github.com/nhanaz-pm-pl/ProfanityFilter/actions/workflows/phpstan.yml)
[![Issues](https://img.shields.io/github/issues/nhanaz-pm-pl/ProfanityFilter)](https://img.shields.io/github/issues/nhanaz-pm-pl/ProfanityFilter)
[![Forks](https://img.shields.io/github/forks/nhanaz-pm-pl/ProfanityFilter)](https://img.shields.io/github/forks/nhanaz-pm-pl/ProfanityFilter)
[![Stars](https://img.shields.io/github/stars/nhanaz-pm-pl/ProfanityFilter)](https://img.shields.io/github/stars/nhanaz-pm-pl/ProfanityFilter)
[![Twitter](https://img.shields.io/twitter/url?url=https%3A%2F%2Fgithub.com%2Fnhanaz-pm-pl%2FProfanityFilter
)](https://img.shields.io/twitter/url?url=https%3A%2F%2Fgithub.com%2Fnhanaz-pm-pl%2FProfanityFilter)
[![Discord](https://img.shields.io/discord/929911970457583626.svg?label=&logo=discord&logoColor=ffffff&color=7389D8&labelColor=6A7EC2)](https://discord.gg/x4CrYtmWhY)

</details>

\- A powerful profanity filter plugin for PocketMine-MP servers

\- ProfanityFilter is an open-source developed by [NhanAZ](https://github.com/NhanAZ)

<!-- TODO
<details> <summary>Table of Contents</summary>

1. General
2. Directory Tree
3. Resources
4. License
5. Credits

</details>
-->

## Directory Tree

<details>

```
ProfanityFilter.
│   .editorconfig
│   .gitattributes
│   .gitignore
│   .poggit.yml
│   CODE_OF_CONDUCT.md
│   composer.json
│   composer.lock
│   CONTRIBUTING.md
│   LICENSE
│   phpstan.neon.dist
│   plugin.yml
│   README.md
│   SECURITY.md
│
├───.github
│   │   FUNDING.yml
│   │   pull_request_template.md
│   │
│   ├───ISSUE_TEMPLATE
│   │       bug_report.md
│   │       feature_request.md
│   │
│   └───workflows
│           phpstan.yml
│
├───.vscode
│       settings.json
│
├───assets
│   │   preg_replace.php
│   │   profanities.yml
│   │
│   └───images
│           icon.png
│           swearing.png
│
├───resources
│   │   config.yml
│   │   profanities.yml
│   │
│   └───languages
│           eng.ini
│           vie.ini
│
└───src
    └───NhanAZ
        └───ProfanityFilter
                EventListener.php
                ProfanityFilter.php
                VersionInfo.php
```

</details>

## Resources

<details> <summary>config.yml</summary>

```yaml
---
# Available languages:
# eng (English)
# vie (Tiếng Việt)
language: "eng"

# Plugin's prefix
prefix: "&f[&cProfanityFilter&f]&r "

# Send a warning to players if their messages contain profanity
warningMode: true

# Format of messages sent to Console
warningMessage: "{playerName} > {msg}"

# Character used to replace filtered words
characterReplaced: "*"

# Show profanity on the console
showProfanity: true
...

```

</details>

<details> <summary>profanities.yml</summary>

```yaml
---
# List of profanity words
profanities:
  - "wtf"
  - "đụ"
...

```

</details>

<details> <summary>languages</summary>

<details> <summary>eng.ini</summary>

```
warning.message = "&cPlease don't use profanity!"
is.development.build = "You are using the development builds. Development builds might have unexpected bugs, crash, break your plugins, corrupt all your data and more. Unless you're a developer and know what you're doing, please AVOID using development builds in production!"
```

</details>

<details> <summary>vie.ini</summary>

```
warning.message = "&cVui lòng không sử dụng các từ ngữ thô tục!"
is.development.build = "Bạn đang sử dụng bản dựng phát triển. Bản dựng phát triển có thể có lỗi không mong muốn, gặp sự cố, phá vỡ các plugin, làm hỏng tất cả dữ liệu của bạn và hơn thế nữa. Trừ khi bạn là nhà phát triển và biết mình đang làm gì, vui lòng TRÁNH bằng cách sử dụng bản dựng phát triển trong sản xuất!"
```

</details>

</details>

## License

<details> <summary>This project is licensed under the <a href="/LICENSE">MIT License</a></summary>

```
MIT License

Copyright (c) 2022 NhanAZ

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
```

</details>

## Credits

\- <a href="https://www.flaticon.com/free-icons/profanity" title="profanity icons">Profanity icons created by Freepik - Flaticon</a>

\- <a href="https://shields.io" title="shield badges">Shield badges created by Shields.IO</a>

<p align="right">[<a href="#top">Back To Top</a>]</p>