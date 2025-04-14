<style>
        .gallery-image {
            position: relative;
            overflow: hidden;
            cursor: pointer;
        }
        .gallery-image img {
            width: 100%;
            transition: transform 0.5s;
        }
        .gallery-image:hover img {
            transform: scale(1.1);
        }
        .gallery-description {
            position: absolute;
            bottom: 0;
            background: rgba(0, 0, 0, 0.6);
            color: #B5BBC9;
            width: 100%;
            padding: 10px;
            transform: translateY(100%);
            transition: transform 0.3s;

        }
        .gallery-image:hover .gallery-description {
            transform: translateY(0);
            
        }
    </style>

    <div class="container my-5">
        <div class="row">
            <?php
            $conn = new mysqli("localhost", "root", "", "gymdb");
            $result = $conn->query("SELECT * FROM tbl_gellery");
            while ($row = $result->fetch_assoc()) {
                echo '<div class="col-md-4 mb-4">';
                echo '<div class="gallery-image">';
                echo '<img src="'.$row['photo'].'" alt="Image">';
                echo '<div class="gallery-description">'.$row['name'] . '<p style="font-size: 10px">'. $row['Description'].'</p> </div>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>


