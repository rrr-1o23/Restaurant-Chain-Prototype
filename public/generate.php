<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Users</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-center mb-4">Generate Users</h5>
                        <form action="index.php" method="post">

                            <div class="mb-3">
                                <label for="countRange" class="form-label">Number of Employees: <span id="employeeCountValue">5</span></label>
                                <input type="range" id="countRange" name="employeeCount" min="5" max="20" value="5" class="form-range" oninput="document.getElementById('employeeCountValue').innerText = this.value">
                            </div>

                            <div class="mb-3">
                                <label for="countRange" class="form-label">Number of Locations: <span id="locationCountValue">2</span></label>
                                <input type="range" id="countRange" name="locationCount" min="2" max="10" value="2" class="form-range" oninput="document.getElementById('locationCountValue').innerText = this.value">
                            </div>

                            <div class="mb-3">
                                <label for="format" class="form-label">Download Format:</label>
                                <select id="format" name="format" class="form-select">
                                    <option value="html">HTML</option>
                                    <option value="markdown">Markdown</option>
                                    <option value="json">JSON</option>
                                    <option value="txt">Text</option>
                                </select>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Generate</button>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
