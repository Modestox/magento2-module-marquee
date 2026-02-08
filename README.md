# Modestox Marquee for Magento 2

A lightweight, high-performance scrolling text (marquee) module for the Magento 2 storefront. Developed using **PHP 8.3** standards and native CSS3 animations for maximum smoothness and minimal impact on page load.

---

### 🚀 Key Features

* **Admin UI Management:** Full control over announcement text, background/font colors, and animation speed.
* **Smart Scheduling:** Configure specific start and end times for each marquee line (Start/End time).
* **Flexible Sorting:** Manage the display order of multiple messages using the numerical **Position** field.

---

### 🛠 Technical Requirements

| Component | Requirement   |
| :--- |:--------------|
| **PHP** | 8.3 or higher |
| **Magento** | 2.4.8+        |
| **License** | MIT           |

---

### 📦 Installation

Run the standard Magento commands in your project root:

```bash
bin/magento module:enable Modestox_Marquee
bin/magento setup:upgrade
bin/magento cache:clean
