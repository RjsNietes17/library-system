<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login-feature.php");
    exit;
}
require_once "database-feature.php";

$searchTerm = trim($_GET["q"] ?? "");
$results = [];

if ($searchTerm !== "") {
    $sql = "SELECT * FROM books
            WHERE title LIKE :q
               OR author LIKE :q
               OR year LIKE :qYear
            ORDER BY year DESC, title ASC
            LIMIT 100";
    $stmt = $pdo->prepare($sql);
    $like = "%" . $searchTerm . "%";
    $stmt->bindValue(":q", $like, PDO::PARAM_STR);
    // allow numeric-only search for year exact match too
    if (ctype_digit($searchTerm)) {
        $stmt->bindValue(":qYear", $searchTerm, PDO::PARAM_STR);
    } else {
        $stmt->bindValue(":qYear", $like, PDO::PARAM_STR);
    }
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

if (isset($_GET["logout"])) {
    session_destroy();
    header("Location: login-feature.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Library Dashboard</title>
    <style>
    :root {
        --bg: #f2f4f8;
        --card: #ffffff;
        --text: #1f2937;
        --muted: #555;
        --primary: #4c6ef5;
        --primary-hover: #3b5bdb;
        --table-head: #f1f3f5;
        --row-hover: #f8f9fa;
        --highlight: #fff3bf;
    }

    body.dark {
        --bg: #0f172a;
        --card: #1e293b;
        --text: #e5e7eb;
        --muted: #9ca3af;
        --primary: #6366f1;
        --primary-hover: #4f46e5;
        --table-head: #334155;
        --row-hover: #1f2937;
        --highlight: #854d0e;
    }

    body {
        font-family: Arial, sans-serif;
        background: var(--bg);
        color: var(--text);
        margin: 0;
        transition: background 0.3s, color 0.3s;
    }

    .header {
        background: var(--primary);
        color: #ffffff;
        padding: 10px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .header a {
        color: #ffffff;
        text-decoration: none;
        margin-left: 10px;
        font-size: 14px;
    }

    .theme-btn {
        background: rgba(255,255,255,0.2);
        border: none;
        color: #fff;
        padding: 6px 10px;
        border-radius: 4px;
        cursor: pointer;
        margin-left: 10px;
    }

    .container {
        padding: 20px;
    }

    .search-box,
    table {
        background: var(--card);
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }

    .search-box {
        padding: 15px;
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
    }

    .search-box input {
        flex: 1;
        padding: 8px;
        border-radius: 4px;
        border: 1px solid #ccc;
    }

    .search-box button {
        padding: 8px 14px;
        border-radius: 4px;
        border: none;
        background: var(--primary);
        color: #fff;
        cursor: pointer;
    }

    .search-box button:hover {
        background: var(--primary-hover);
    }

    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }

    th, td {
        padding: 8px 10px;
        border-bottom: 1px solid #334155;
    }

    th {
        background: var(--table-head);
    }

    tr:hover {
        background: var(--row-hover);
    }

    .no-results {
        color: var(--muted);
    }

    .highlight {
        background: var(--highlight);
    }

    .theme-switch {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    color: #fff;
    }

    .switch {
        position: relative;
        width: 48px;
        height: 22px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0; left: 0; right: 0; bottom: 0;
        background-color: #cbd5f5;
        border-radius: 999px;
        transition: 0.3s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 18px;
        width: 18px;
        left: 2px;
        bottom: 2px;
        background-color: white;
        border-radius: 50%;
        transition: 0.3s;
    }

    .switch input:checked + .slider {
        background-color: #1e293b;
    }

    .switch input:checked + .slider:before {
        transform: translateX(26px);
    }

    </style>

</head>
<body>
<div class="header">
    <div>Library Dashboard</div>
    <div class="user theme-switch">
        <span>Theme</span>
        <span>Light</span>

        <label class="switch">
            <input type="checkbox" id="themeToggle">
            <span class="slider"></span>
        </label>

        <span>Dark</span>

        <span style="margin-left:12px;">
            <?php echo htmlspecialchars($_SESSION["username"]); ?>
            <a href="?logout=1">Logout</a>
        </span>
    </div>
</div>
<div class="container">
    <h2>Search Books</h2>
    <form class="search-box" method="get" onsubmit="return validateSearch();">
        <input type="text" name="q" id="searchInput"
               placeholder="Search by title, author, or year..."
               value="<?php echo htmlspecialchars($searchTerm); ?>">
        <button type="submit">Search</button>
    </form>

    <?php if ($searchTerm !== ""): ?>
        <div class="no-results">
            Showing results for: <strong><?php echo htmlspecialchars($searchTerm); ?></strong>
            (<?php echo count($results); ?> found)
        </div>
    <?php endif; ?>

    <?php if (!empty($results)): ?>
        <table id="resultsTable">
            <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Year</th>
                <th>Comments</th>
                <th>Floor</th>
                <th>Isle</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($results as $row): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row["title"]); ?></td>
                    <td><?php echo htmlspecialchars($row["author"]); ?></td>
                    <td><?php echo htmlspecialchars($row["year"]); ?></td>
                    <td><?php echo htmlspecialchars($row["comments"]); ?></td>
                    <td><?php echo htmlspecialchars($row["floor"]); ?></td>
                    <td><?php echo htmlspecialchars($row["isle"]); ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php elseif ($searchTerm !== ""): ?>
        <div class="no-results">No books found for that search.</div>
    <?php endif; ?>
</div>

<script>
    function validateSearch() {
        const input = document.getElementById("searchInput");
        if (input.value.trim() === "") {
            alert("Please enter a search term (title, author, or year).");
            return false;
        }
        return true;
    }

    (function highlight() {
        const term = "<?php echo htmlspecialchars($searchTerm, ENT_QUOTES); ?>";
        if (!term) return;

        const table = document.getElementById("resultsTable");
        if (!table) return;

        const regex = new RegExp("(" + term.replace(/[.*+?^${}()|[\]\\]/g, "\\$&") + ")", "gi");

        Array.from(table.getElementsByTagName("td")).forEach(td => {
            td.innerHTML = td.textContent.replace(regex, '<span class="highlight">$1</span>');
        });
    })();
</script>
<script>
const toggle = document.getElementById("themeToggle");

// Load saved theme
(function () {
    const savedTheme = localStorage.getItem("theme");
    if (savedTheme === "dark") {
        document.body.classList.add("dark");
        toggle.checked = true;
    }
})();

// Toggle event
toggle.addEventListener("change", function () {
    if (this.checked) {
        document.body.classList.add("dark");
        localStorage.setItem("theme", "dark");
    } else {
        document.body.classList.remove("dark");
        localStorage.setItem("theme", "light");
    }
});
</script>


</body>
</html>
