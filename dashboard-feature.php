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
        body {
            font-family: Arial, sans-serif;
            background: #f2f4f8;
            margin: 0;
        }
        .header {
            background: #4c6ef5;
            color: #ffffff;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header .user {
            font-size: 14px;
        }
        .header a {
            color: #ffffff;
            text-decoration: none;
            margin-left: 10px;
            font-size: 14px;
        }
        .container {
            padding: 20px;
        }
        h2 {
            margin-top: 0;
        }
        .search-box {
            background: #ffffff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .search-box input[type="text"] {
            flex: 1;
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ccd0d5;
            font-size: 14px;
        }
        .search-box button {
            padding: 8px 14px;
            border-radius: 4px;
            border: none;
            background: #4c6ef5;
            color: #ffffff;
            font-size: 14px;
            cursor: pointer;
        }
        .search-box button:hover {
            background: #3b5bdb;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            font-size: 13px;
        }
        th, td {
            padding: 8px 10px;
            border-bottom: 1px solid #e5e9f0;
            text-align: left;
        }
        th {
            background: #f1f3f5;
        }
        tr:hover {
            background: #f8f9fa;
        }
        .no-results {
            margin-top: 10px;
            font-size: 14px;
            color: #555;
        }
        .highlight {
            background: #fff3bf;
        }
    </style>
</head>
<body>
<div class="header">
    <div>Library Dashboard</div>
    <div class="user">
        Logged in as: <?php echo htmlspecialchars($_SESSION["username"]); ?>
        <a href="?logout=1">Logout</a>
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
</body>
</html>