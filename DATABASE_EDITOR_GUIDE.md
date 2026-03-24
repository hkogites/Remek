# 🗄️ DATABASE EDITOR - COMPLETE GUIDE

## 🎯 Overview

The **Database Editor** is a powerful, interactive console application that provides a user-friendly menu-driven interface for managing your SmartVoyager database. No need to remember complex commands - just follow the menus!

## 🚀 Quick Start

### **Launch the Database Editor:**
```bash
cd d:\BIZTONSÁG\2\fesu\Remek
php artisan db:edit
```

### **What You'll See:**
```
🗄️  Database Editor
==================
Welcome to the interactive database editor!

📋 Main Menu:
1. 👥 Edit Users
2. 📝 Edit Reservations
3. 🗺️  Edit Destinations
4. 📊 View All Tables
5. ⚡ Quick Actions
6. 🚪 Exit

Enter your choice (1-6):
```

---

## 📋 MAIN MENU FEATURES

### **1. 👥 Edit Users**
Complete user management with full CRUD operations.

**Available Operations:**
- 📋 **List Users** - View all users with roles
- ➕ **Create User** - Add new users with roles
- ✏️ **Update User** - Modify user details
- 🗑️ **Delete User** - Remove users safely
- 🔍 **Search Users** - Find users by name/email

**Example Usage:**
```
👤 User Operations:
1. 📋 List Users
2. ➕ Create User
3. ✏️  Update User
4. 🗑️  Delete User
5. 🔍 Search Users
6. ⬅️  Back to Main Menu
```

---

### **2. 📝 Edit Reservations**
Full reservation management system.

**Available Operations:**
- 📋 **List Reservations** - View all reservations with destinations
- ✏️ **Update Status** - Change reservation status (pending/confirmed/cancelled)
- 🗑️ **Delete Reservation** - Remove reservations
- 🔍 **Search Reservations** - Find by name, email, or status
- ➕ **Create Reservation** - Add new reservations

**Example Usage:**
```
📋 Reservations List:
+----+------------+------------------+-----------+---------+-------------+------------+
| ID | Name       | Email            | Status    | People  | Destination | Date       |
+----+------------+------------------+-----------+---------+-------------+------------+
| 1  | John Doe   | john@email.com   | pending   | 2       | Prague      | 2024-01-15 |
+----+------------+------------------+-----------+---------+-------------+------------+
```

---

### **3. 🗺️ Edit Destinations**
Complete destination management.

**Available Operations:**
- 📋 **List Destinations** - View all destinations with prices
- ➕ **Create Destination** - Add new travel destinations
- ✏️ **Update Destination** - Modify destination details
- 🗑️ **Delete Destination** - Remove destinations
- 🔍 **Search Destinations** - Find by title or description

**Example Usage:**
```
📋 Destinations List:
+----+----------------+-------------+-------------+------------+
| ID | Title          | Price (HUF)  | Start Date  | End Date   |
+----+----------------+-------------+-------------+------------+
| 1  | Prague Trip    | 150,000      | 2024-06-01  | 2024-06-07 |
+----+----------------+-------------+-------------+------------+
```

---

### **4. 📊 View All Tables**
Quick database overview with statistics.

**Features:**
- 📊 **Record counts** for all tables
- 📈 **Recent activity** from all tables
- 📋 **Summary statistics** at a glance

**Example Output:**
```
📊 Database Overview
--------------------
+-------------+---------+
| Table       | Records |
+-------------+---------+
| Users       | 15      |
| Reservations| 42      |
| Destinations| 8       |
+-------------+---------+

Recent Activity:
👥 Recent Users: John Doe, Jane Smith, Bob Wilson
📝 Recent Reservations: Alice Brown, Charlie Davis
🗺️ Recent Destinations: Paris Tour, Rome Adventure
```

---

### **5. ⚡ Quick Actions**
Common tasks with single-click execution.

**Available Actions:**
- 🧹 **Clear Pending Reservations** - Bulk cleanup
- 👤 **Create Test User** - Quick admin account
- 📊 **Show Statistics** - Detailed database stats
- 💾 **Backup Data** - Create JSON backup

**Example Usage:**
```
⚡ Quick Actions:
1. 🧹 Clear Pending Reservations
2. 👤 Create Test User
3. 📊 Show Statistics
4. 💾 Backup Data
5. ⬅️  Back to Main Menu
```

---

## 🔧 DETAILED OPERATIONS

### **User Management Examples:**

#### **Create New User:**
```
➕ Create New User
Enter user name: John Smith
Enter user email: john@example.com
Enter password: ******
Is this user an admin? (yes/no) [no]: yes
Is this user an iroda user? (yes/no) [no]: yes
✅ User created successfully!
```

#### **Update User:**
```
✏️ Update User
Enter user ID to update: 1
Current user: John Doe (john@example.com)
Enter new name [John Doe]: John Smith
Enter new email [john@example.com]: john.smith@example.com
Change password? (yes/no) [no]: yes
Enter new password: ******
Is admin? [Current: Yes]: yes
Is iroda? [Current: Yes]: yes
✅ User updated successfully!
```

---

### **Reservation Management Examples:**

#### **Update Reservation Status:**
```
✏️ Update Reservation Status
Enter reservation ID: 5
Current status: pending
Available statuses: pending, confirmed, cancelled
Enter new status: confirmed
✅ Reservation status updated successfully!
```

#### **Create New Reservation:**
```
➕ Create New Reservation
Enter full name: Alice Johnson
Enter email: alice@example.com
Enter phone: +36 30 123 4567
Enter number of people: 3
Select status: [0] pending, [1] confirmed, [2] cancelled
> 0

Available destinations:
1. Prague Trip - 150,000 HUF
2. Paris Tour - 200,000 HUF
3. Rome Adventure - 180,000 HUF
Select destination number: 1
✅ Reservation created successfully!
```

---

### **Destination Management Examples:**

#### **Create New Destination:**
```
➕ Create New Destination
Enter destination title: Budapest Weekend
Enter description: Amazing weekend in the heart of Hungary
Enter price (HUF): 120000
Enter start date (YYYY-MM-DD): 2024-07-15
Enter end date (YYYY-MM-DD): 2024-07-17
✅ Destination created successfully!
```

---

## 🔍 SEARCH FEATURES

### **Search Users:**
```
🔍 Search Users
Enter search term (name or email): john
🔍 Search Results for 'john':
+----+------------+------------------+-------+-------+
| ID | Name       | Email            | Admin | Iroda |
+----+------------+------------------+-------+-------+
| 1  | John Doe   | john@example.com | ✅    | ✅    |
| 5  | Johnny     | johnny@email.com | ❌    | ✅    |
+----+------------+------------------+-------+-------+
```

### **Search Reservations:**
```
🔍 Search Reservations
Enter search term (name, email, or status): pending
🔍 Search Results for 'pending':
+----+-------------+------------------+----------+---------+------------+
| ID | Name        | Email            | Status   | People  | Date       |
+----+-------------+------------------+----------+---------+------------+
| 3  | Bob Wilson  | bob@email.com    | pending  | 2       | 2024-01-20 |
| 7  | Eve Davis   | eve@email.com    | pending  | 4       | 2024-01-22 |
+----+-------------+------------------+----------+---------+------------+
```

---

## ⚡ QUICK ACTIONS

### **Clear Pending Reservations:**
```
🧹 Clear Pending Reservations
Found 5 pending reservations.
Clear all pending reservations? (yes/no) [no]: yes
✅ Cleared 5 pending reservations!
```

### **Create Test User:**
```
👤 Create Test User
✅ Test user created successfully!
Email: test@example.com
Password: password
```

### **Show Statistics:**
```
📊 Database Statistics
--------------------
Total Users: 15
Admin Users: 3
Iroda Users: 8
Total Reservations: 42
Pending Reservations: 5
Confirmed Reservations: 35
Cancelled Reservations: 2
Total Destinations: 8
```

### **Backup Data:**
```
💾 Creating data backup...
✅ Backup created: backup_2024-01-20_14-30-15.json
Location: D:\BIZTONSÁG\2\fesu\Remek\storage\app\backups\backup_2024-01-20_14-30-15.json
```

---

## 🛡️ SAFETY FEATURES

### **Confirmation Prompts:**
- ✅ **Delete operations** require confirmation
- ✅ **Destructive actions** show warnings
- ✅ **Email validation** prevents duplicates
- ✅ **Status validation** ensures valid inputs

### **Error Handling:**
- ✅ **Record not found** messages
- ✅ **Invalid input** validation
- ✅ **Database error** handling
- ✅ **Graceful failure** recovery

---

## 📊 DATA FORMATTING

### **Tables Display:**
- ✅ **Formatted columns** with proper alignment
- ✅ **Status indicators** (✅/❌ for booleans)
- ✅ **Number formatting** for prices
- ✅ **Date formatting** for readability
- ✅ **Limited results** (20 items max) for performance

### **Search Results:**
- ✅ **Highlight matching** terms
- ✅ **Limited results** (10 items max)
- ✅ **Relevant columns** displayed
- ✅ **Count indicators** for results

---

## 🎯 BEST PRACTICES

### **For Beginners:**
1. **Start with "View All Tables"** to understand your data
2. **Use search features** to find specific records
3. **Always confirm** before deleting anything
4. **Create backups** before major changes

### **For Advanced Users:**
1. **Use Quick Actions** for common tasks
2. **Leverage search** for bulk operations
3. **Check statistics** regularly
4. **Backup before** major updates

---

## 🔧 TROUBLESHOOTING

### **Common Issues:**
- **Database connection errors** - Check your .env configuration
- **Permission denied** - Ensure database user has proper rights
- **Record not found** - Verify the ID exists
- **Email already exists** - Use search to find duplicates

### **Solutions:**
1. **Check database connection** with `php artisan db:manage list`
2. **Verify user permissions** in your database
3. **Use search instead of ID** when unsure
4. **Create backup** before major operations

---

## 🚀 PRO TIPS

### **Efficiency Tips:**
- 🎯 **Use search** instead of browsing large lists
- ⚡ **Quick Actions** for common tasks
- 📊 **Statistics** to monitor database health
- 💾 **Regular backups** for safety

### **Navigation Tips:**
- 🔄 **Use numbers** for menu navigation
- 📝 **Type "exit"** to return to previous menu
- 🔍 **Search is case-insensitive**
- 📋 **Results are limited** for performance

---

## 🎉 SUMMARY

The **Database Editor** provides:

- ✅ **Complete CRUD operations** for all major tables
- ✅ **Interactive menu system** for ease of use
- ✅ **Search functionality** for quick access
- ✅ **Safety features** to prevent accidents
- ✅ **Quick actions** for common tasks
- ✅ **Data backup** capabilities
- ✅ **Statistics and monitoring** tools

**Perfect for:**
- 🎯 **Database administration** without web interface
- 🔧 **Quick fixes** and data management
- 📊 **Data analysis** and monitoring
- 💾 **Backup and maintenance** operations

**Ready to use:** `php artisan db:edit` 🚀
