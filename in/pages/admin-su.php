<div class="card-body">

    <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">All</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Paid Service</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Free Service</a>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="table-responsive">
                <table class="table mb-0" id="table1">
                    <thead class="thead-dark sticky">
                        <tr>
                            <th>SL</th>
                            <th>CREATED ON</th>
                            <th>UPDATED BY</th>
                            <th>IP</th>
                            <th>FULL URL</th>
                            <th>SHORT CODE</th>
                            <th>HITS</th>
                            <th>CURRENT VALIDITY</th>
                            <th>VALID FROM TO</th>
                            <th>STATUS</th>
                            <th>ACTIVATE FOR</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $all_urls = getAllURLs($conn, 'all');
                        $count = 1;

                        if (mysqli_num_rows($all_urls)) {
                            while ($row = mysqli_fetch_assoc($all_urls)) {


                        ?>
                                <tr>
                                    <td><?= $count ?></td>
                                    <td>
                                        <?php
                                        $dateTime = new DateTime($row['created_at']);
                                        $formattedDate = $dateTime->format('M d, Y');
                                        echo $formattedDate;
                                        ?>
                                    </td>
                                    <td><?= $row['updated_by'] ?></td>
                                    <td><?= $row['ip'] ?></td>
                                    <td style="max-width: 250px; overflow: hidden;"><a target="_blank" href="<?= $row['full_url'] ?>"><?= $row['full_url'] ?></a></td>
                                    <td><a target="_blank" href="../<?= $row['short_url_code'] ?>"><?= $row['short_url_code'] ?></a> <i style="cursor: pointer;" onclick="copy_short_url('<?= site_url() . '/' . DIRNAME . $row['short_url_code'] ?>')" class="bi bi-clipboard"></i></td>
                                    <td><?= $row['hits'] ?></td>
                                    <td><?= $row['validity'] ?> days</td>
                                    <td>
                                        <?php
                                        $valid_from = new DateTime($row['valid_from']);
                                        $valid_from = $valid_from->format('M d, Y');
                                        $valid_till = new DateTime($row['valid_till']);
                                        $valid_till = $valid_till->format('M d, Y');
                                        echo $valid_from . " TO " . $valid_till;
                                        ?>
                                    </td>
                                    <td><?= $row['is_active'] == 1 ? 'Active' : 'Deactive' ?></td>
                                    <td>
                                        <select id="change_to" class="form-select" onchange="url_action('<?= site_url() . '/' . DIRNAME ?>','change_validity', <?= $row['id'] ?>, this.value)">
                                            <?php
                                            if ($row['validity'] == 180) {
                                                echo '
                                                                    <option value="180" selected>6 months</option>
                                                                    <option value="365">12 months</option>
                                                                    ';
                                            } else {
                                                echo '
                                                                        <option value="180">6 months</option>
                                                                        <option value="365" selected>12 months</option>
                                                                    ';
                                            }
                                            ?>

                                        </select>
                                    </td>
                                    <td id="actions">
                                        <?php
                                        if ($row['is_active'] == 1) {
                                            echo '<a style="cursor: pointer; color: blue;" title="Disable" onclick="url_action(\'' . site_url() . '/' . DIRNAME . '\', \'disable\', ' . $row['id'] . ')"><i class="fas fa-pause-circle"></i></a>';
                                        } else {
                                            echo '<a style="cursor: pointer; color: blue;" title="Enable" onclick="url_action(\'' . site_url() . '/' . DIRNAME . '\', \'enable\', ' . $row['id'] . ')"><i class="fas fa-play-circle"></i></a>';
                                        }
                                        ?>
                                        <a style="cursor: pointer; color: blue;" title="Trash" onclick="url_action('<?= site_url() . '/' . DIRNAME ?>', 'delete', <?= $row['id'] ?>)"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                        <?php
                                $count++;
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="table-responsive">
                <table class="table mb-0" id="table2">
                    <thead class="thead-dark">
                        <tr>
                            <th>SL</th>
                            <th>CREATED ON</th>
                            <th>CREATED BY</th>
                            <th>UPDATED BY</th>
                            <th>IP</th>
                            <th>FULL URL</th>
                            <th>SHORT CODE</th>
                            <th>HITS</th>
                            <th>CURRENT VALIDITY</th>
                            <th>VALID FROM TO</th>
                            <th>STATUS</th>
                            <th>ACTIVATE FOR</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $all_urls = getAllURLs($conn, 'paid');
                        $count = 1;

                        if (mysqli_num_rows($all_urls)) {
                            while ($row = mysqli_fetch_assoc($all_urls)) {


                        ?>
                                <tr>
                                    <td><?= $count ?></td>
                                    <td>
                                        <?php
                                        $dateTime = new DateTime($row['created_at']);
                                        $formattedDate = $dateTime->format('M d, Y');
                                        echo $formattedDate;
                                        ?>
                                    </td>
                                    <td><?= $row['updated_by'] ?></td>
                                    <td><?= $row['ip'] ?></td>
                                    <td style="max-width: 250px; overflow: hidden;"><a target="_blank" href="<?= $row['full_url'] ?>"><?= $row['full_url'] ?></a></td>
                                    <td><a target="_blank" href="../<?= $row['short_url_code'] ?>"><?= $row['short_url_code'] ?></a> <i style="cursor: pointer;" onclick="copy_short_url('<?= site_url() . '/' . DIRNAME . $row['short_url_code'] ?>')" class="bi bi-clipboard"></i></td>
                                    <td><?= $row['hits'] ?></td>
                                    <td><?= $row['validity'] ?> days</td>
                                    <td>
                                        <?php
                                        $valid_from = new DateTime($row['valid_from']);
                                        $valid_from = $valid_from->format('M d, Y');
                                        $valid_till = new DateTime($row['valid_till']);
                                        $valid_till = $valid_till->format('M d, Y');
                                        echo $valid_from . " TO " . $valid_till;
                                        ?>
                                    </td>
                                    <td><?= $row['is_active'] == 1 ? 'Active' : 'Deactive' ?></td>
                                    <td>
                                        <select id="change_to" class="form-select" onchange="url_action('<?= site_url() . '/' . DIRNAME ?>','change_validity', <?= $row['id'] ?>, this.value)">
                                            <?php
                                            if ($row['validity'] == 180) {
                                                echo '
                                                    <option value="180" selected>6 months</option>
                                                    <option value="365">12 months</option>
                                                    ';
                                            } else {
                                                echo '
                                                    <option value="180">6 months</option>
                                                    <option value="365" selected>12 months</option>
                                                    ';
                                            }
                                            ?>

                                        </select>
                                    </td>
                                    <td id="actions">
                                        <?php
                                        if ($row['is_active'] == 1) {
                                            echo '<a style="cursor: pointer; color: blue;" title="Disable" onclick="url_action(\'' . site_url() . '/' . DIRNAME . '\', \'disable\', ' . $row['id'] . ')"><i class="fas fa-pause-circle"></i></a>';
                                        } else {
                                            echo '<a style="cursor: pointer; color: blue;" title="Enable" onclick="url_action(\'' . site_url() . '/' . DIRNAME . '\', \'enable\', ' . $row['id'] . ')"><i class="fas fa-play-circle"></i></a>';
                                        }
                                        ?>
                                        <a style="cursor: pointer; color: blue;" title="Trash" onclick="url_action('<?= site_url() . '/' . DIRNAME ?>', 'delete', <?= $row['id'] ?>)"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                        <?php
                                $count++;
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
            <div class="table-responsive">
                <table class="table mb-0" id="table3">
                    <thead class="thead-dark">
                        <tr>
                            <th>SL</th>
                            <th>CREATED ON</th>
                            <th>UPDATED BY</th>
                            <th>IP</th>
                            <th>FULL URL</th>
                            <th>SHORT CODE</th>
                            <th>HITS</th>
                            <th>CURRENT VALIDITY</th>
                            <th>VALID FROM TO</th>
                            <th>STATUS</th>
                            <th>ACTIVATE FOR</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $all_urls = getAllURLs($conn, 'free');
                        $count = 1;

                        if (mysqli_num_rows($all_urls)) {
                            while ($row = mysqli_fetch_assoc($all_urls)) {


                        ?>
                                <tr>
                                    <td><?= $count ?></td>
                                    <td>
                                        <?php
                                        $dateTime = new DateTime($row['created_at']);
                                        $formattedDate = $dateTime->format('M d, Y');
                                        echo $formattedDate;
                                        ?>
                                    </td>
                                    <td><?= $row['updated_by'] ?></td>
                                    <td><?= $row['ip'] ?></td>
                                    <td style="max-width: 250px; overflow: hidden;"><a target="_blank" href="<?= $row['full_url'] ?>"><?= $row['full_url'] ?></a></td>
                                    <td><a target="_blank" href="../<?= $row['short_url_code'] ?>"><?= $row['short_url_code'] ?></a> <i style="cursor: pointer;" onclick="copy_short_url('<?= site_url() . '/' . DIRNAME . $row['short_url_code'] ?>')" class="bi bi-clipboard"></i></td>
                                    <td><?= $row['hits'] ?></td>
                                    <td><?= $row['validity'] ?> days</td>
                                    <td>
                                        <?php
                                        $valid_from = new DateTime($row['valid_from']);
                                        $valid_from = $valid_from->format('M d, Y');
                                        $valid_till = new DateTime($row['valid_till']);
                                        $valid_till = $valid_till->format('M d, Y');
                                        echo $valid_from . " TO " . $valid_till;
                                        ?>
                                    </td>
                                    <td><?= $row['is_active'] == 1 ? 'Active' : 'Deactive' ?></td>
                                    <td>
                                        <select id="change_to" class="form-select" onchange="url_action('<?= site_url() . '/' . DIRNAME ?>','change_validity', <?= $row['id'] ?>, this.value)">
                                            <?php
                                            if ($row['validity'] == 180) {
                                                echo '
                                                                    <option value="180" selected>6 months</option>
                                                                    <option value="365">12 months</option>
                                                                    ';
                                            } else {
                                                echo '
                                                                    <option value="180">6 months</option>
                                                                    <option value="365" selected>12 months</option>
                                                                    ';
                                            }
                                            ?>

                                        </select>
                                    </td>
                                    <td id="actions">
                                        <?php
                                        if ($row['is_active'] == 1) {
                                            echo '<a style="cursor: pointer; color: blue;" title="Disable" onclick="url_action(\'' . DIRNAME . '\', \'disable\', ' . $row['id'] . ')"><i class="fas fa-pause-circle"></i></a>';
                                        } else {
                                            echo '<a style="cursor: pointer; color: blue;" title="Enable" onclick="url_action(\'' . DIRNAME . '\', \'enable\', ' . $row['id'] . ')"><i class="fas fa-play-circle"></i></a>';
                                        }
                                        ?>
                                        <a style="cursor: pointer; color: blue;" title="Trash" onclick="url_action('<?= DIRNAME ?>', 'delete', <?= $row['id'] ?>)"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                        <?php
                                $count++;
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</div>