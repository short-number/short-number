#!/usr/bin/env bash
# Creates the 7 short-number issues on GitHub from the markdown files in
# .github/ISSUE_TEMPLATE/. Run this locally where you are authenticated.
#
# Usage:
#   ./create-issues.sh <owner/repo>
#
# Requires either:
#   - gh CLI logged in (gh auth login), OR
#   - GITHUB_TOKEN env var with a classic PAT that has 'repo' scope
set -euo pipefail

REPO="${1:?Usage: $0 <owner/repo>}"
DIR="$(cd "$(dirname "$0")" && pwd)/.github/ISSUE_TEMPLATE"

# file => issue title
declare -a FILES=(
  "russian-and-ukrainian-suffixes-contain-typos.md|Russian and Ukrainian suffixes contain typos"
  "formatting-disables-japanese-and-chinese-default-rewrites.md|Formatting disables Japanese and Chinese default rewrites"
  "an-empty-array-does-not-clear-overwrites.md|An empty array does not clear overwrites"
  "settings-persist-between-requests-in-long-running-workers.md|Settings persist between requests in long-running workers"
  "short-does-not-document-its-range-exception.md|short() does not document its range exception"
  "documentation-uses-incorrect-method-names-and-output.md|Documentation uses incorrect method names and output"
  "clarify-the-chinese-trillion-convention.md|Clarify the Chinese trillion convention"
)

extract_body() { awk 'NR==1 && /^---$/{inf=1; next} inf && /^---$/{inf=0; next} !inf' "$1"; }

if command -v gh >/dev/null 2>&1; then
  for entry in "${FILES[@]}"; do
    f="${entry%%|*}"; title="${entry#*|}"
    echo "Creating via gh: $title"
    gh issue create --repo "$REPO" --title "$title" --body-file <(extract_body "$DIR/$f")
  done
elif [[ -n "${GITHUB_TOKEN:-}" ]]; then
  for entry in "${FILES[@]}"; do
    f="${entry%%|*}"; title="${entry#*|}"
    echo "Creating via API: $title"
    body="$(extract_body "$DIR/$f")"
    jq -n --arg t "$title" --arg b "$body" '{title:$t, body:$b}' |
      curl -sf -X POST \
        -H "Authorization: Bearer $GITHUB_TOKEN" \
        -H "Accept: application/vnd.github+json" \
        "https://api.github.com/repos/$REPO/issues" \
        -d @- | jq -r '.html_url'
  done
else
  echo "Error: install/authenticate the gh CLI, or export GITHUB_TOKEN with 'repo' scope." >&2
  exit 1
fi

echo "Done."
