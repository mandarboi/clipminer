# ClipMiner – Brand & UI Tokens

Dokumen ini adalah **acuan resmi desain UI ClipMiner**.  
Semua halaman, komponen, dan fitur **WAJIB mengacu ke file ini**.

---

## 🎨 Color System

### Primary (Brand / Action)
Digunakan untuk CTA utama, button, badge, highlight penting.

- Hex: `#6366F1`
- Tailwind:
  - `bg-indigo-500`
  - `hover:bg-indigo-400`
  - `text-indigo-400`

---

### Background (Base)
Digunakan untuk background utama aplikasi (dark mode).

- Hex: `#0F1220`
- Tailwind:
  - `bg-[#0f1220]`

---

### Surface (Card / Panel)
Digunakan untuk card, modal, panel, preview box.

- Hex: `#1A1F36`
- Tailwind:
  - `bg-[#1a1f36]`

---

## ✍️ Typography

- Font default: **System UI**
- Heading:
  - `text-2xl` – `text-3xl`
  - `font-bold`
- Body:
  - `text-sm` – `text-base`
- Secondary text:
  - `text-white/60`
  - `text-white/70`

---

## 🧱 Layout & Spacing

- Container max width:
  - `max-w-7xl`
- Page padding:
  - `px-6 py-12`
- Card padding:
  - `p-4` / `p-6` / `p-8`
- Gap standar:
  - `gap-4` / `gap-6` / `gap-10`

---

## 🔘 Button Style

### Primary Button
```html
<a class="bg-indigo-600 hover:bg-indigo-500 text-white
          px-4 py-3 rounded-xl font-semibold transition">
