# 07 — n8n Workflow Specification

**Source:** PRD Final Master AKDISI Website v5.0  
**Status:** Final  
**Date:** 2026-09-06  
**Reference:** PRD AKDISI Website v5.0.md, Sections 59–61

---

## TODO Checklist

### Workflow Setup
- [ ] n8n installation
- [ ] Database setup
- [ ] Credentials configuration
- [ ] Webhook endpoints
- [ ] Trigger setup

### Content Workflow
- [ ] Keyword input
- [ ] Topic generation
- [ ] Content brief
- [ ] Outline generation
- [ ] AI draft generation
- [ ] SEO metadata generation
- [ ] WordPress draft creation
- [ ] Human review step
- [ ] Approval workflow
- [ ] Publish step
- [ ] Notification

### Integration
- [ ] WordPress connection
- [ ] OpenAI/AI provider
- [ ] Email notification
- [ ] Error handling

---

## PART A — N8N OVERVIEW

### Purpose

n8n adalah content operations layer untuk AKDISI:

- Keyword research → Topic → Content brief → Outline → AI Draft → SEO Metadata → Human Review → WordPress Draft → Approval → Publish → Notification

### Workflow States

```
DRAFT → REVIEW → APPROVED → PUBLISHED → UPDATE → ARCHIVE
```

---

## PART B — WORKFLOW ARCHITECTURE

### Main Content Workflow

```
┌─────────────┐
│  TRIGGER     │  ← Manual trigger or scheduled
│  (Cron)      │
└──────┬──────┘
       │
       ▼
┌─────────────┐
│  KEYWORD     │  ← Input keyword from list
│  INPUT       │
└──────┬──────┘
       │
       ▼
┌─────────────┐
│  TOPIC       │  ← Generate topic based on keyword
│  GENERATION  │
└──────┬──────┘
       │
       ▼
┌─────────────┐
│  CONTENT     │  ← Generate content brief
│  BRIEF       │
└──────┬──────┘
       │
       ▼
┌─────────────┐
│  OUTLINE     │  ← Generate article outline
│  GENERATION  │
└──────┬──────┘
       │
       ▼
┌─────────────┐
│  AI DRAFT    │  ← Generate full article draft
│  GENERATION  │
└──────┬──────┘
       │
       ▼
┌─────────────┐
│  SEO         │  ← Generate SEO metadata
│  METADATA    │     title, description, keywords
└──────┬──────┘
       │
       ▼
┌─────────────┐
│  WORDPRESS   │  ← Create WordPress draft
│  DRAFT       │
└──────┬──────┘
       │
       ▼
┌─────────────┐
│  HUMAN       │  ← Manual review (approval required)
│  REVIEW      │
└──────┬──────┘
       │
       ▼
┌─────────────┐
│  APPROVAL    │  ← Approve or Reject
│  GATE        │
└──────┬──────┘
       │
       ▼
┌─────────────┐
│  PUBLISH     │  ← Publish to WordPress
│  PUBLISH     │
└──────┬──────┘
       │
       ▼
┌─────────────┐
│  NOTIFICATION│  ← Send notification
│              │     (Email/Slack)
└─────────────┘
```

---

## PART C — WORKFLOW DETAIL

### Trigger

**Manual Trigger** (primary):
- Triggered by content manager
- Input: keyword(s)

**Scheduled Trigger** (optional):
- Weekly content schedule
- Input: keyword list from database

### Step 1: Keyword Input

```
Input: Keyword from list or manual entry
Output: { keyword, pillar, intent }
```

Keyword list categories:
- Local: jasa pembuatan aplikasi Jambi
- Industry: aplikasi perumahan
- Problem: digitalisasi administrasi perumahan
- Educational: aplikasi custom vs software siap pakai

### Step 2: Topic Generation

```
Input: Keyword
Output: { topic, angle, target_audience }
```

AI Prompt:
```
Generate a content topic based on keyword: {keyword}
Target audience: B2B decision makers
Tone: professional, clear, consultative
Pillar: {pillar}
Output: JSON { topic, angle, target_audience }
```

### Step 3: Content Brief

```
Input: Topic
Output: { title, outline, key_points, word_count }
```

AI Prompt:
```
Create a content brief for: {topic}
Include:
- Title options (3 variants)
- Outline (H2/H3 structure)
- Key points to cover
- Target word count: 1500-2000 words
- CTA direction
Output: JSON { title, outline, key_points, word_count }
```

### Step 4: Outline Generation

```
Input: Content brief
Output: detailed outline with H2/H3
```

AI Prompt:
```
Create detailed outline for: {title}
Include:
- H1 (page title)
- H2 sections (main sections)
- H3 subsections (if needed)
- Estimated word count per section
- Internal linking opportunities
Output: JSON { h1, h2_sections, h3_subsections }
```

### Step 5: AI Draft Generation

```
Input: Outline
Output: Full article draft
```

AI Prompt:
```
Write article based on outline: {outline}
Rules:
- Professional, consultative tone
- No jargon without explanation
- Include CTA at end
- 1500-2000 words
- Include internal links
Output: Full article text
```

### Step 6: SEO Metadata Generation

```
Input: Article draft
Output: SEO title, meta description, keywords
```

AI Prompt:
```
Generate SEO metadata for article:
- Title (60 chars max)
- Meta description (150-160 chars)
- Keywords (5-10)
- Focus keyword
Output: JSON { title, description, keywords, focus_keyword }
```

### Step 7: WordPress Draft Creation

```
Input: Article + SEO metadata
Output: WordPress draft post
```

WordPress API call:
```
POST /wp-json/wp/v2/posts
{
  "title": "...",
  "content": "...",
  "status": "draft",
  "categories": [...],
  "meta": {
    "seo_title": "...",
    "seo_description": "..."
  }
}
```

### Step 8: Human Review

```
State: DRAFT → REVIEW
Action: Content manager reviews
Decision: Approve / Reject / Edit
```

### Step 9: Approval Gate

```
IF approved → PUBLISH
IF rejected → REVISION
IF edit → RETURN TO DRAFT
```

### Step 10: Publish

```
Input: Approved draft
Output: Published post
```

WordPress API call:
```
POST /wp-json/wp/v2/posts/{id}
{
  "status": "publish"
}
```

### Step 11: Notification

```
Trigger: Published
Action: Send notification
Channel: Email / Slack / n8n internal
```

Notification content:
- Article title
- URL
- Published date
- Author

---

## PART D — AI GOVERNANCE

### Rule: AI Cannot Auto-Publish

Default state: AI draft requires human approval.

Human approval required for:

- [ ] Company claims
- [ ] Client references
- [ ] Statistics
- [ ] Industry claims
- [ ] Legal/regulatory information
- [ ] Portfolio mentions
- [ ] Final article content

### Review Checklist

Before approving AI-generated content:

- [ ] All claims verified
- [ ] No fake statistics
- [ ] No fake client references
- [ ] Tone consistent with brand
- [ ] SEO metadata correct
- [ ] Internal links correct
- [ ] CTA present
- [ ] No plagiarism
- [ ] Grammatically correct

---

## PART E — INTEGRATIONS

### WordPress Connection

```json
{
  "type": "wordpress",
  "url": "https://akdisi.com",
  "username": "content_manager",
  "application_password": "xxxx"
}
```

### AI Provider

```json
{
  "type": "openai",
  "model": "gpt-4",
  "api_key": "{{$env.OPENAI_API_KEY}}"
}
```

### Email Notification

```json
{
  "type": "smtp",
  "host": "smtp.example.com",
  "port": 587,
  "user": "content@akdisi.com",
  "password": "{{$env.SMTP_PASSWORD}}"
}
```

---

## PART F — ERROR HANDLING

### Retry Logic

```
Max retries: 3
Retry delay: 5s
Retry on: API error, timeout
```

### Error Notifications

```
IF workflow fails:
  → Send error notification to admin
  → Log error details
  → Do not publish draft
```

---

## PART G — MONITORING

### Metrics to Track

| Metric | Target | Alert If |
|--------|--------|----------|
| Workflow success rate | >95% | <90% |
| Content creation time | <2h | >4h |
| Draft to publish time | <24h | >72h |
| AI approval rate | >80% | <70% |
| Error rate | <5% | >10% |

### Dashboard

```
n8n Dashboard:
- Workflow runs (24h)
- Success rate
- Average execution time
- Error count
```

---

## PART H — SECURITY

### API Key Management

```
Store in n8n credentials (encrypted)
Never hardcode in workflow
Rotate regularly
Limit access to content team only
```

### WordPress Security

- Use application passwords (not admin password)
- Limit IP access to WordPress REST API
- Enable rate limiting
- Log all API calls

---

## PART I — DEPLOYMENT

### n8n Setup

1. Install n8n (Docker recommended)
2. Configure database (PostgreSQL)
3. Set up credentials
4. Import workflow
5. Test workflow
6. Activate workflow

### Environment Variables

```env
N8N_HOST=localhost
N8N_PORT=5678
N8N_PROTOCOL=https
N8N_BASIC_AUTH_ACTIVE=true
N8N_BASIC_AUTH_USER=admin
N8N_BASIC_AUTH_PASSWORD=secure
DB_TYPE=postgresdb
DB_POSTgresDB_HOST=localhost
DB_POSTgresDB_PORT=5432
DB_POSTgresDB_DATABASE=n8n
DB_POSTgresDB_USER=n8n
DB_POSTgresDB_PASSWORD=secure
```

---

## PART J — VERIFICATION CHECKLIST

Before marking n8n spec complete:

- [ ] Workflow diagram documented
- [ ] All steps defined
- [ ] AI governance rules set
- [ ] WordPress integration tested
- [ ] Error handling configured
- [ ] Monitoring dashboard set
- [ ] Security requirements met
- [ ] Deployment documented
