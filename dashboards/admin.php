<?php
require_once '../includes/db.php';
require_once '../includes/global.php';
require_once '../includes/header.php';

// Handle POST requests for status updates
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
  $id = $_POST['id'];
  $table = $_POST['table'];
  $status = $_POST['action'] === 'verify' ? 'verified' : 'rejected';

  $updateQuery = "UPDATE $table SET status = ? WHERE " .
    ($table === 'members' ? 'mem_id' : 'id') . " = ?";
  $stmt = mysqli_prepare($conn, $updateQuery);
  mysqli_stmt_bind_param($stmt, "si", $status, $id);
  mysqli_stmt_execute($stmt);
}

// Fetch statistics
$stats = [
  'users' => mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM users"))['count'],
  'members' => mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM members"))['count'],
  'courses' => mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM courses"))['count'],
  'services' => mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM services"))['count'],
  'freelancers' => mysqli_fetch_assoc(mysqli_query(
    $conn,
    "SELECT COUNT(*) as count FROM members WHERE role = 'freelancer'"
  ))['count'],
  'pending_docs' => mysqli_fetch_assoc(mysqli_query(
    $conn,
    "SELECT COUNT(*) as count FROM instructor_documents"
  ))['count']
];
?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Sphatik</title>
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  </head>

  <body>
    <div class="admin-container">
      <div class="sidebar">
        <h2>Admin Panel</h2>
        <ul class="nav-links">
          <li><a href="#dashboard" class="active" data-tab="dashboard">
              <i class="fas fa-home"></i>Dashboard</a></li>
          <li><a href="#users" data-tab="users">
              <i class="fas fa-users"></i>Users</a></li>
          <li><a href="#members" data-tab="members">
              <i class="fas fa-user-tie"></i>Members</a></li>
          <li><a href="#courses" data-tab="courses">
              <i class="fas fa-book"></i>Courses</a></li>
          <li><a href="#services" data-tab="services">
              <i class="fas fa-wrench"></i>Services</a></li>
          <li><a href="#freelancers" data-tab="freelancers">
              <i class="fas fa-briefcase"></i>Freelancers</a></li>
          <li><a href="#documents" data-tab="documents">
              <i class="fas fa-file"></i>Documents</a></li>
          <!-- <li><a href="../auth/logout.php">
              <i class="fas fa-sign-out-alt"></i>Logout</a></li> -->
        </ul>
      </div>

      <div class="main-content">
        <!-- Dashboard Overview -->
        <div id="dashboard" class="tab-content active">
          <h2>Dashboard Overview</h2>
          <div class="stats-grid">
            <div class="stat-card">
              <div class="stat-number"><?= $stats['users'] ?></div>
              <div class="stat-label">Users</div>
            </div>
            <div class="stat-card">
              <div class="stat-number"><?= $stats['members'] ?></div>
              <div class="stat-label">Members</div>
            </div>
            <div class="stat-card">
              <div class="stat-number"><?= $stats['courses'] ?></div>
              <div class="stat-label">Courses</div>
            </div>
            <div class="stat-card">
              <div class="stat-number"><?= $stats['services'] ?></div>
              <div class="stat-label">Services</div>
            </div>
            <div class="stat-card">
              <div class="stat-number"><?= $stats['freelancers'] ?></div>
              <div class="stat-label">Freelancers</div>
            </div>
            <div class="stat-card">
              <div class="stat-number"><?= $stats['pending_docs'] ?></div>
              <div class="stat-label">Pending Documents</div>
            </div>
          </div>
        </div>

        <!-- Users Management -->
        <div id="users" class="tab-content">
          <h2>User Management</h2>
          <input type="text" class="search-box" placeholder="Search users...">
          <table class="data-table">
            <thead>
              <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $users = mysqli_query($conn, "SELECT * FROM users ORDER BY created_at DESC");
              while ($user = mysqli_fetch_assoc($users)) {
                echo "<tr>
                                <td>{$user['username']}</td>
                                <td>{$user['email']}</td>
                                <td>{$user['phone']}</td>
                                <td><span class='status-badge status-{$user['status']}'>{$user['status']}</span></td>
                                <td>
                                    <button class='action-btn view-btn'>View</button>
                                    <button class='action-btn verify-btn' 
                                        data-id='{$user['user_id']}' 
                                        data-table='users'>Activate</button>
                                    <button class='action-btn reject-btn' 
                                        data-id='{$user['user_id']}' 
                                        data-table='users'>Deactivate</button>
                                </td>
                            </tr>";
              }
              ?>
            </tbody>
          </table>
        </div>

        <!-- Members Management -->
        <div id="members" class="tab-content">
          <h2>Member Management</h2>
          <div class="filters">
            <input type="text" class="search-box" placeholder="Search members...">
            <select class="filter-dropdown">
              <option value="">All Roles</option>
              <option value="instructor">Instructor</option>
              <option value="local_service_provider">Service Provider</option>
              <option value="freelancer">Freelancer</option>
            </select>
          </div>
          <table class="data-table">
            <thead>
              <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $members = mysqli_query($conn, "SELECT * FROM members ORDER BY created_at DESC");
              while ($member = mysqli_fetch_assoc($members)) {
                echo "<tr>
                                <td>{$member['username']}</td>
                                <td>{$member['email']}</td>
                                <td>{$member['role']}</td>
                                <td><span class='status-badge status-{$member['status']}'>{$member['status']}</span></td>
                                <td>
                                    <button class='action-btn view-btn'>View</button>
                                    <button class='action-btn verify-btn' 
                                        data-id='{$member['mem_id']}' 
                                        data-table='members'>Verify</button>
                                    <button class='action-btn reject-btn' 
                                        data-id='{$member['mem_id']}' 
                                        data-table='members'>Reject</button>
                                </td>
                            </tr>";
              }
              ?>
            </tbody>
          </table>
        </div>

        <!-- Document Verification -->
        <div id="documents" class="tab-content">
          <h2>Document Verification</h2>
          <table class="data-table">
            <thead>
              <tr>
                <th>Member</th>
                <th>College</th>
                <th>Designation</th>
                <th>Documents</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $docs = mysqli_query($conn, "
                            SELECT d.*, m.username, m.email 
                            FROM instructor_documents d 
                            JOIN members m ON d.mem_id = m.mem_id 
                            ORDER BY d.uploaded_at DESC
                        ");
              while ($doc = mysqli_fetch_assoc($docs)) {
                echo "<tr>
                                <td>{$doc['username']}<br><small>{$doc['email']}</small></td>
                                <td>{$doc['college_name']}</td>
                                <td>{$doc['designation']}</td>
                                <td>
                                    <button class='action-btn view-btn' data-doc='{$doc['gov_id_proof']}'>ID Proof</button>
                                    <button class='action-btn view-btn' data-doc='{$doc['qualification_proof']}'>Qualification</button>
                                    <button class='action-btn view-btn' data-doc='{$doc['college_id_card']}'>College ID</button>
                                </td>
                                <td>
                                    <button class='action-btn verify-btn' 
                                        data-id='{$doc['mem_id']}' 
                                        data-table='members'>Verify</button>
                                    <button class='action-btn reject-btn' 
                                        data-id='{$doc['mem_id']}' 
                                        data-table='members'>Reject</button>
                                </td>
                            </tr>";
              }
              ?>
            </tbody>
          </table>
        </div>

        <!-- Document Preview Modal -->
        <div id="documentModal" class="modal">
          <div class="modal-content">
            <span class="close-modal">&times;</span>
            <h3>Document Preview</h3>
            <img class="document-preview" src="" alt="Document Preview">
          </div>
        </div>
      </div>
    </div>

    <script>
      // Tab switching
      document.querySelectorAll('.nav-links a').forEach(link => {
        link.addEventListener('click', (e) => {
          e.preventDefault();
          const tabId = link.getAttribute('data-tab');

          document.querySelectorAll('.nav-links a').forEach(a =>
            a.classList.remove('active'));
          link.classList.add('active');

          document.querySelectorAll('.tab-content').forEach(tab =>
            tab.style.display = 'none');
          document.getElementById(tabId).style.display = 'block';
        });
      });

      // Status update handlers
      document.querySelectorAll('.verify-btn, .reject-btn').forEach(button => {
        button.addEventListener('click', async (e) => {
          const action = e.target.classList.contains('verify-btn') ? 'verify' : 'reject';
          const id = e.target.dataset.id;
          const table = e.target.dataset.table;

          try {
            const response = await fetch('update_status.php', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
              },
              body: `action=${action}&id=${id}&table=${table}`
            });

            if (response.ok) {
              location.reload();
            }
          } catch (error) {
            console.error('Error:', error);
          }
        });
      });

      // Document preview modal
      const modal = document.getElementById('documentModal');
      const modalImg = modal.querySelector('.document-preview');
      const closeModal = modal.querySelector('.close-modal');

      document.querySelectorAll('[data-doc]').forEach(button => {
        button.addEventListener('click', () => {
          modalImg.src = button.dataset.doc;
          modal.style.display = 'block';
        });
      });

      closeModal.addEventListener('click', () => {
        modal.style.display = 'none';
      });

      window.addEventListener('click', (e) => {
        if (e.target === modal) {
          modal.style.display = 'none';
        }
      });

      // Search functionality
      document.querySelectorAll('.search-box').forEach(searchBox => {
        searchBox.addEventListener('input', (e) => {
          const searchTerm = e.target.value.toLowerCase();
          const table = e.target.closest('.tab-content').querySelector('.data-table');
          const rows = table.querySelectorAll('tbody tr');

          rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
          });
        });
      });

      // Role filter
      document.querySelector('.filter-dropdown').addEventListener('change', (e) => {
        const role = e.target.value.toLowerCase();
        const rows = document.querySelectorAll('#members .data-table tbody tr');

        rows.forEach(row => {
          const rowRole = row.children[2].textContent.toLowerCase();
          row.style.display = !role || rowRole === role ? '' : 'none';
        });
      });
    </script>
  </body>

</html>