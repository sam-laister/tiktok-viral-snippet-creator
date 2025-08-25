## TikTok Viral Snippet Creator

⚠️ Heavily WIP ⚠️

This tool will eventually become a command line utility to generate the viral Mario Kart snippet videos recently blowing up with Lil Uzi snippets.

The projects goal is to entirely automate the system using GPT's Whisper tool. Everything will run locally.

### Usage

`bin/console --profile app:generate:audio <path to audio>`

### TODO

- [x] Symfony command for executing Whisper
- [ ] Temporary storage for srt generated files
- [ ] Video rendering and export
- [ ] Http route for cross use between dockers