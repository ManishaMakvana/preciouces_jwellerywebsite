<?php
// Database connection (replace with your actual database credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jewelry_shop";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, name, category, price, sale_price, image_data FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="home.js"></script>


    <link rel="stylesheet" href="homes.css">
   

    <style>
      .productname{
        display:grid;
      }  
.choice{
        display: flex;
        align-items: center;
        width: 200px;

    }
 .whish{
        padding-left: 20px;
        font-size: 30px;
        color: indianred;
    }

    
/* Styling the cart count badge */
#cart-count {
    
    top: -10px;  /* Adjust as needed */
    right: -10px;  /* Adjust as needed */
    background-color: red;
    color: white;
    border-radius: 50%;
    padding: 5px 10px;
    font-size: 12px;
    font-weight: bold;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 25px;
    height: 25px;
}

/* Remove margin-left from product-list, it's unnecessary now */
#product-list {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    margin: 20px;
}
    /* Centering the product grid */


/* General styling for the product grid */


/* Styling individual product items */
.product-item {
    border: 1px solid #ddd;
    padding: 15px;
    text-align: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    background-color: #fff;
}

/* Image styling */
.image-container img {
    width: 100%; /* Full width of the container */
    height: auto;
    max-width: 300px;
    max-height: 300px;
    object-fit: cover; /* Makes sure the image maintains its aspect ratio */
}
/* Product actions styling */
.product-actions {
    margin-top: 10px;
    display: flex; /* Enables flexbox */
    justify-content: center; /* Centers items horizontally */
    align-items: center; /* Centers items vertically */
    gap: 10px; /* Adds space between the button and the icon */
}

.add-to-cart {
    padding: 10px 15px;
    background-color: #ff5a5f;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px; /* Consistent text size */
}

.add-to-cart:hover {
    background-color: #28a745; /* Change to green on hover */
}

.add-to-wishlist {
    color: #ff5a5f;
    text-decoration: none;
    font-size: 24px; /* Adjust font size for the heart icon */
    border: none; /* Removes the border */
    background: none; /* Removes any background */
    outline: none; /* Removes the outline when focused */
    cursor: pointer; /* Adds a pointer cursor */
    display: flex; /* For centering icon */
    align-items: center; /* Aligns the heart icon vertically */
    padding: 0; /* Removes padding */
}

.add-to-wishlist:hover {
    color: #ff3339;
}


/* Responsive design for smaller screens */
@media (max-width: 768px) {
    .product-grid {
        grid-template-columns: repeat(3, 1fr); /* 2 columns on smaller screens */
    }
}

@media (max-width: 480px) {
    .product-grid {
        grid-template-columns: 1fr; /* Single column on very small screens */
    }
}


    </style>

  
</head>
<body class="showcart"> 
    <!-- header -->
    <header>
        <div id="head-top">
            <div id="logo" class="border"></div>

            <div class="dropdown  border">
                <button class="dropdown-button">SHOP BY CATEGORY</button>
                <div class="dropdown-content">
                    <a href="earrings.php">Earrings</a>
                    <a href="nosering.php">Nose Ring</a>
                    <a href="necklaces.php">Necklace</a>
                    <a href="rings.php">Ring</a>
                
                   
                </div>
            </div>
        
            <div class="dropdown1 border">
                <button class="dropdown-button1">SHOP BY LOOK </button>
                <div class="dropdown-content1">
                    <a href="gold_radiance.php">Gold Radiance</a>
                    <a href="oxodise.php">Oxidised Jewels</a>
                    <a href="silver.php"> Silver</a>
                    <a href="kundan.php">Kundan</a>
                </div>
            </div>


            <div class="dropdown2 border">
                <button class="dropdown-button2">SHOP BY PRICE</button>
                <div class="dropdown-content2">
                    <a href="under.php">Under 999</a>
                    <a href="under1499.php">999-1499</a>
                    <a href="under1999.php">1499-1999</a> 
                   
                </div>
            </div>
           <!-- list  -->
            <div id="list" class="border" >
                <input placeholder="search items" id="search-input" class="border" >
                <div class="search-icon ">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
                
<script>
    document.getElementById('search-input').addEventListener('input', function () {
        let filter = this.value.toLowerCase();
        let products = document.querySelectorAll('.product-item');

        products.forEach(function (product) {
            let productName = product.querySelector('.product-name').textContent.toLowerCase();
            let productCategory = product.querySelector('.category').textContent.toLowerCase();

            // Check if the product name or category matches the search query
            if (productName.includes(filter) || productCategory.includes(filter)) {
                product.style.display = '';
            } else {
                product.style.display = 'none';
            }
        });
    });
</script>
            </div>
                <div class="account border">
                    <a href="registers.php"><i class="fa-regular fa-user" id="dropdown-content3"></i></a>
                    
                </div>
                
                <div class="wise border">
                    <a href="wishlist.php" class="add-to-wishlist" data-id="product1"><i class="fa-regular fa-heart"></i></a>
                </div>

                <div class="cart border">
    <form method="POST" action="confirm_order.php"> <!-- Submit to cart_icon_click.php -->
        <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($row['id']); ?>">
        <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($row['name']); ?>">
        <input type="hidden" name="product_price" value="<?php echo htmlspecialchars($row['price']); ?>">
        <input type="hidden" name="product_image" value="<?php echo base64_encode($row['image_data']); ?>">
        <button type="submit" class="add-to-wishlist">
            <i class="fa-solid fa-cart-plus"></i> 
        </button>
    </form>
</div>

      
                                          <!-- JavaScript to handle the "Add to Cart" functionality -->




               
    </header>

    <!-- main -->

    <main>
        <div class="main-box">
        <div class="imgs">
            <div class="earring-img1"></div>
            <a href="earrings.php"><p class="per">Earrings</p></a>
        </div>
    
        <div class="imgs">
            <div class="earring-img2"></div>
            <a href="necklaces.php" ><p class="per">Necklace</p></a>
        </div>
    
       
        <div class="imgs">
            <div class="earring-img4"></div>
            <a href="nosering.php"><p class="per" >Nose Ring</p></a>
        </div>
    
        <div class="imgs">
            <div class="earring-img5"></div>
            <a href="rings.php"><p class="per">Ring</p></a>
        </div>
    
       

    </div>
    <div id="offerimg">
        <img src="offer/1offer.webp" height="120px" width="100%" >
    </div>

    <div class="heading">
       <h1 id="head1"><span>PURE SILVER
    </span></h1> 
    </div>
    
    <div class="gallary-wrap">
        <div class="gallary">
        <div class="offer-imges" id="divo">
            <div class=" offer1"></div>
            <div class=" offer2"></div>
            <div class=" offer3"></div>
        </div>
    
        <div class="offer-imges" id="divo">
            <div class=" offer4"></div>
            <div class=" offer5"></div>
            <div class=" offer6"></div>
           
        </div>
    </div>

    <div class="heading">
        <h1 id="head1"><span>PURE GOLD </span></h1> </div>
        
        <div class="jwellerybox1">
            <div class="jwellery1">
            <div  id="jweprice1">
                <div class="jwelleryprice11"></div>
                <div class="jwelleryprice12"></div>
                <div class=" jwelleryprice13"></div>
                <div class="jwelleryprice14"></div>
            </div>

            <div  id="jweprice1">
                <div class="jwelleryprice15"></div>
                <div class="jwelleryprice16"></div>
                <div class="jwelleryprice17"></div>
                <div class="jwelleryprice18"></div>
            </div>
            
            </div>
        </div>

    
     

        
  
    <!-- collection -->
    <div class="heading">
        <h1 id="head1"><span>COLLECTIONS</span></h1> </div>
        
        <div class="jwellerybox">
            <div class="jwellery">
            <div class="jwelleryprice" id="jweprice">
                <div class="jwelleryprice1"></div>
                <div class="jwelleryprice2"></div>
                <div class=" jwelleryprice3"></div>
                <div class="jwelleryprice4"></div>
            </div>

            <div class="jwelleryprice" id="jweprice">
                <div class="jwelleryprice5"></div>
                <div class="jwelleryprice6"></div>
                <div class=" jwelleryprice7"></div>
                <div class="jwelleryprice8"></div>
            </div>
            
            </div>
        </div>

        <div class="heading">
            <h1 id="head1"><span>BEST SELLERS</span></h1> </div>
        </div>

        <div id="product-list" class="product-grid">
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="product-item">';
            echo '<h2 class="product-name">' . htmlspecialchars($row['name']) . '</h2>';
            echo '<div class="image-container">';
            echo '<img src="data:image/jpeg;base64,' . base64_encode($row['image_data']) . '" alt="' . htmlspecialchars($row['name']) . '" width="300" height="300">';
            echo '</div>';
            echo '<p class="category">Category: ' . htmlspecialchars($row['category']) . '</p>';
            echo '<p>Price: ₹' . htmlspecialchars($row['price']) . '</p>';
            if (!empty($row['sale_price'])) {
                echo '<p>Sale Price: ₹' . htmlspecialchars($row['sale_price']) . '</p>';
            }
            echo '<div class="product-actions">';

            // Confirm Booking Form
            echo '<form method="POST" action="confirm_order.php">';
            echo '<input type="hidden" name="product_id" value="' . htmlspecialchars($row['id']) . '">';
            echo '<input type="hidden" name="product_name" value="' . htmlspecialchars($row['name']) . '">';
            echo '<input type="hidden" name="product_price" value="' . htmlspecialchars($row['price']) . '">';
            echo '<input type="hidden" name="product_image" value="' . base64_encode($row['image_data']) . '">';
            echo '<button type="submit" class="add-to-cart">Buy Now</button>';
            echo '</form>';

            // Wishlist Form
            echo '<form method="POST" action="wishlist.php">';
            echo '<input type="hidden" name="product_id" value="' . htmlspecialchars($row['id']) . '">';
            echo '<input type="hidden" name="product_name" value="' . htmlspecialchars($row['name']) . '">';
            echo '<input type="hidden" name="product_price" value="' . htmlspecialchars($row['price']) . '">';
            echo '<input type="hidden" name="product_image" value="' . base64_encode($row['image_data']) . '">';
            echo '<button type="submit" class="add-to-wishlist">';
            echo '<i class="fa-solid fa-heart"></i>';
            echo '</button>';
            echo '</form>';

            echo '</div>'; // Close product-actions
            echo '</div>'; // Close product-item
        }
    } else {
        echo '<p>No products found</p>';
    }

    $conn->close();
    ?>
</div>


   

   

</div>

        
    
  
    </main>
    <div class="heading">
        <h1 id="head1"><span>SHOP BY PRICE
     </span></h1> 
    </div>
    </div>               
<!-- sale-price -->
    <div class="salebox">
        <div class="sale">
        <div class="saleprice" id="price">
            <div class="price1 "></div>
            <div class="price2"></div>
            <div class=" price3"></div>
            <div class=" price4"></div>
        </div>
        </div>
    </div>   

<footer>
    <div class="footer-box">
        <div class="boxf">
        <div class="boxf1" style="margin-top: 20px;">
            <h2>Associate With Us</h2>
            <ul>
                <li>
                    <a href="about.html"><span>About</span></a>
                </li>

                <li>
                    <a href="contact.html"><span>Contact Us</span></a>
                </li>
            </ul>
        </div>
        <div class="boxf2"  style="margin-top: 20px;"> 
            <h2>Policy Matters</h2>
            <ul>
                <li>
                    <a href="terms.html"><span>Terms of Use</span></a>
                </li>

                <li>
                    <a href="privacy.html"><span> Privacy Policy</span></a>
                </li>
            </ul>
        </div>
        <div class="boxf3" style="margin-top: 20px;">
            <ul>
                <li>
                    <span><i class="fa-brands fa-whatsapp"></i></span>
                    <span>+91 72300 66751</span>
                </li>

                <li>
                    <span><i class="fa-regular fa-envelope"></i></span>
                    <span>help@preciouces.com</span>
                </li>
                <li>
                    <span>Gujarat, Gandhinage-382006</span> 
                    <span>India</span>
                </li>
            </ul>
            
        </div>
    </div>
</footer>
</body>
</html>