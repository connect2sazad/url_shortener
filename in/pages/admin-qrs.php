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
                            <th>QR</th>
                            <th>STATUS</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $all_urls = getAllQRs($conn, 'all');
                        $count = 1;

                        if (mysqli_num_rows($all_urls)) {
                            while ($row = mysqli_fetch_assoc($all_urls)) {

                        ?>
                                <tr>
                                    <td><?= $count ?></td>
                                    <td>
                                        <?php
                                        $dateTime = new DateTime($row['created_at']);
                                        $formattedDate = $dateTime->format('d M, Y h:i A');
                                        echo $formattedDate;
                                        ?>
                                    </td>
                                    <td><?= $row['updated_by'] ?></td>
                                    <td><?= $row['ip'] ?></td>
                                    <td style="max-width: 250px; overflow: hidden;"><a id="full-url-a<?= $count ?>" target="_blank" href="<?= $row['full_url'] ?>"><?= $row['full_url'] ?></a></td>
                                    <td class="uit" id="uit-a<?= $count ?>">
                                        <i class="bi bi-qr-code" data-bs-toggle="modal" data-bs-target="#qr-generation-modal" onclick="generate_qrcode('<?= $row['full_url'] ?>')"></i>
                                    </td>
                                    <td><?= $row['is_active'] == 1 ? 'Active' : 'Deactive' ?></td>
                                    <td id="actions">
                                        <?php
                                        if ($row['is_active'] == 1) {
                                            echo '<a style="cursor: pointer; color: blue;" title="Disable" onclick="qr_action(\'' . site_url() . '/' . DIRNAME . '\', \'disable\', ' . $row['id'] . ')"><i class="fas fa-pause-circle"></i></a>';
                                        } else {
                                            echo '<a style="cursor: pointer; color: blue;" title="Enable" onclick="qr_action(\'' . site_url() . '/' . DIRNAME . '\', \'enable\', ' . $row['id'] . ')"><i class="fas fa-play-circle"></i></a>';
                                        }
                                        ?>
                                        <a style="cursor: pointer; color: blue;" title="Trash" onclick="qr_action('<?= site_url() . '/' . DIRNAME ?>', 'delete', <?= $row['id'] ?>)"><i class="fas fa-trash"></i></a>
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
                            <th>UPDATED BY</th>
                            <th>IP</th>
                            <th>FULL URL</th>
                            <th>QR</th>
                            <th>STATUS</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $all_urls = getAllQRs($conn, 'paid');
                        $count = 1;

                        if (mysqli_num_rows($all_urls)) {
                            while ($row = mysqli_fetch_assoc($all_urls)) {

                        ?>
                                <tr>
                                    <td><?= $count ?></td>
                                    <td>
                                        <?php
                                        $dateTime = new DateTime($row['created_at']);
                                        $formattedDate = $dateTime->format('d M, Y h:i A');
                                        echo $formattedDate;
                                        ?>
                                    </td>
                                    <td><?= $row['updated_by'] ?></td>
                                    <td><?= $row['ip'] ?></td>
                                    <td style="max-width: 250px; overflow: hidden;"><a id="full-url-a<?= $count ?>" target="_blank" href="<?= $row['full_url'] ?>"><?= $row['full_url'] ?></a></td>
                                    <td class="uit" id="uit-a<?= $count ?>">
                                        <i class="bi bi-qr-code" data-bs-toggle="modal" data-bs-target="#qr-generation-modal" onclick="generate_qrcode('<?= $row['full_url'] ?>')"></i>
                                    </td>
                                    <td><?= $row['is_active'] == 1 ? 'Active' : 'Deactive' ?></td>
                                    <td id="actions">
                                        <?php
                                        if ($row['is_active'] == 1) {
                                            echo '<a style="cursor: pointer; color: blue;" title="Disable" onclick="qr_action(\'' . site_url() . '/' . DIRNAME . '\', \'disable\', ' . $row['id'] . ')"><i class="fas fa-pause-circle"></i></a>';
                                        } else {
                                            echo '<a style="cursor: pointer; color: blue;" title="Enable" onclick="qr_action(\'' . site_url() . '/' . DIRNAME . '\', \'enable\', ' . $row['id'] . ')"><i class="fas fa-play-circle"></i></a>';
                                        }
                                        ?>
                                        <a style="cursor: pointer; color: blue;" title="Trash" onclick="qr_action('<?= site_url() . '/' . DIRNAME ?>', 'delete', <?= $row['id'] ?>)"><i class="fas fa-trash"></i></a>
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
                            <th>QR</th>
                            <th>STATUS</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $all_urls = getAllQRs($conn, 'free');
                        $count = 1;

                        if (mysqli_num_rows($all_urls)) {
                            while ($row = mysqli_fetch_assoc($all_urls)) {

                        ?>
                                <tr>
                                    <td><?= $count ?></td>
                                    <td>
                                        <?php
                                        $dateTime = new DateTime($row['created_at']);
                                        $formattedDate = $dateTime->format('d M, Y h:i A');
                                        echo $formattedDate;
                                        ?>
                                    </td>
                                    <td><?= $row['updated_by'] ?></td>
                                    <td><?= $row['ip'] ?></td>
                                    <td style="max-width: 250px; overflow: hidden;"><a id="full-url-a<?= $count ?>" target="_blank" href="<?= $row['full_url'] ?>"><?= $row['full_url'] ?></a></td>
                                    <td class="uit" id="uit-a<?= $count ?>">
                                        <i class="bi bi-qr-code" data-bs-toggle="modal" data-bs-target="#qr-generation-modal" onclick="generate_qrcode('<?= $row['full_url'] ?>')"></i>
                                    </td>
                                    <td><?= $row['is_active'] == 1 ? 'Active' : 'Deactive' ?></td>
                                    <td id="actions">
                                        <?php
                                        if ($row['is_active'] == 1) {
                                            echo '<a style="cursor: pointer; color: blue;" title="Disable" onclick="qr_action(\'' . site_url() . '/' . DIRNAME . '\', \'disable\', ' . $row['id'] . ')"><i class="fas fa-pause-circle"></i></a>';
                                        } else {
                                            echo '<a style="cursor: pointer; color: blue;" title="Enable" onclick="qr_action(\'' . site_url() . '/' . DIRNAME . '\', \'enable\', ' . $row['id'] . ')"><i class="fas fa-play-circle"></i></a>';
                                        }
                                        ?>
                                        <a style="cursor: pointer; color: blue;" title="Trash" onclick="qr_action('<?= site_url() . '/' . DIRNAME ?>', 'delete', <?= $row['id'] ?>)"><i class="fas fa-trash"></i></a>
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