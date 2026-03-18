import os
import shutil

# Paths
base_path = "App/Http/Controllers"
admin_dir = os.path.join(base_path, "Staff")

# Create Admin folder if it doesn't exist
os.makedirs(admin_dir, exist_ok=True)

# Loop through all Admin_*Controller.php files
for filename in os.listdir(base_path):
    if filename.startswith("Staff") and filename.endswith("Controller.php"):
        old_path = os.path.join(base_path, filename)
        new_path = os.path.join(admin_dir, filename)

        print(f"Moving: {filename}")

        # Move file
        shutil.move(old_path, new_path)

        # ---- Update namespace ----
        with open(new_path, "r", encoding="utf-8") as f:
            content = f.read()

        # Replace namespace line
        content = content.replace(
            "namespace App\\Http\\Controllers;",
            "namespace App\\Http\\Controllers\\Staff;"
        )

        # Write updated content
        with open(new_path, "w", encoding="utf-8") as f:
            f.write(content)

print("✔ Done! All Staff controllers moved and namespaces updated.")
