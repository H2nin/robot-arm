<!DOCTYPE html>
<html>
<head>
  <title>Robot Arm Control Panel</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h2>Robot Arm Control Panel</h2>

  <form action="save_pose.php" method="POST">
    <?php for($i = 1; $i <= 6; $i++): ?>
      <label>Motor <?= $i ?>:</label>
      <input type="range" name="motor<?= $i ?>" min="0" max="180" value="90" oninput="document.getElementById('val<?= $i ?>').innerText=this.value">
      <span id="val<?= $i ?>">90</span><br>
    <?php endfor; ?>
    <br>
    <button type="submit">Save Pose</button>
    <button type="button" onclick="runPose()">Run</button>
  </form>

  <script>
    function runPose() {
      fetch('get_run_pose.php')
        .then(res => res.json())
        .then(data => {
          alert("Running pose:\nMotor 1: " + data.motor1 + "\nMotor 2: " + data.motor2);
          fetch('update_status.php'); // بعد التشغيل يخلي status = 0
        });
    }
  </script>

  <hr>
  <h3>Saved Poses</h3>
  <?php
    $conn = new mysqli("localhost", "root", "", "robot_arm");
    $res = $conn->query("SELECT * FROM poses");
  ?>
  <table border="1">
    <tr>
      <th>#</th>
      <?php for($i = 1; $i <= 6; $i++): ?>
        <th>Motor <?= $i ?></th>
      <?php endfor; ?>
      <th>Action</th>
    </tr>
    <?php while($row = $res->fetch_assoc()): ?>
      <tr>
        <td><?= $row['id'] ?></td>
        <?php for($i = 1; $i <= 6; $i++): ?>
          <td><?= $row["motor$i"] ?></td>
        <?php endfor; ?>
        <td>
          <button onclick="loadPose(<?= $row['id'] ?>)">Load</button>
          <button onclick="removePose(<?= $row['id'] ?>)">Remove</button>
        </td>
      </tr>
    <?php endwhile; ?>
  </table>

  <script>
    function loadPose(id) {
      alert("Load pose #" + id + " (function not yet implemented)");
    }

    function removePose(id) {
      fetch("remove_pose.php?id=" + id).then(() => location.reload());
    }
  </script>
</body>
</html>