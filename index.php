<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Test Ecommerce Project with Flutterwave(TEST)</title>
    <link rel="stylesheet" href="assets/css/styles.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="fonts.googleapis.com" rel="stylesheet" />
</head>

<body>
    <!-- Foot Menu -->
    <div class="foot-menu">
        <div class="option" data-foot-nav="home">
            <i class="bi bi-house-door-fill"></i>
            <span>Home</span>
        </div>
        <div class="option" data-foot-nav="categories">
            <i class="bi bi-bookmarks-fill"></i>
            <span>Categories</span>
        </div>
        <div class="option" data-foot-nav="cart">
            <i class="bi bi-cart4"></i>
            <span>Cart</span>
        </div>
        <div class="option">
            <i class="bi bi-three-dots"></i>
            <span>Options</span>
        </div>
    </div>
    <!-- Real Page -->
    <div class="container-fluid">
        <div class="header">
            <h2>AyExpertDev Store</h2>
        </div>
        <div class="container">
            <!-- Pages -->
            <div id="pages">
                <!-- Homepage -->
                <div data-page="home">
                    <!-- Carousel -->
                    <div class="carousel">
                        <!-- Carousel Slide -->
                        <div class="carousel-slide"></div>
                        <!-- Carousel Controls -->
                        <div class="carousel-controls"></div>
                    </div>
                    <!-- Carousel Script -->
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            async function performCarouselActions() {
                                const response = await fetch("./carousel.json");
                                const data = await response.json();
                                data.forEach(({
                                    image
                                }) => {
                                    const carouselSlide = document.querySelector(".carousel-slide");
                                    carouselSlide.innerHTML += `
                                        <div class="carousel-item">
                                            <div class="carousel-image">
                                                <img src="${image}" alt="">
                                            </div>
                                        </div>
                                    `;
                                });
                                // All Carousels in my code(Optional)
                                const carousel = document.querySelectorAll(".carousel");
                                carousel.forEach((singleCarousel) => {
                                    // Single Carousel
                                    const carouselItems = singleCarousel.querySelectorAll(".carousel-item");
                                    for (let id = 0; id < carouselItems.length; id++) {
                                        carouselItems.item(id).id = id;
                                    }
                                    carouselItems.item(0).classList.add("active-item");

                                    let activeItem = 0;

                                    function increase() {
                                        // move to next item
                                        setInterval(() => {
                                            activeItem = (activeItem + 1) % carouselItems.length;

                                            carouselItems.forEach((item, index) => {
                                                if (index === activeItem) {
                                                    item.classList.add("active-item");
                                                } else {
                                                    item.classList.remove("active-item");
                                                }
                                            });
                                        }, 5000);
                                    }
                                    increase();
                                });
                            }
                            // Performs all carousel magics
                            performCarouselActions();
                        });
                    </script>
                    <!-- Carousel End -->
                    <div class="home-products">
                        <h4>RECOMMENDED PRODUCTS</h4>
                        <div class="rec-products">
                            <!-- Recommended products script -->
                            <script>
                                const recPage = document.querySelector(".rec-products");
                                async function fetchRecommended() {
                                    const response = await fetch("./rec-products.json");
                                    const data = await response.json();
                                    data.forEach((recProduct) => {
                                        recPage.innerHTML += `
                                        <div class="product">
                                            <img src="${recProduct.image}" />
                                        </div>
                                        `;
                                    });
                                }
                                fetchRecommended();
                            </script>
                        </div>
                        <h4>PRODUCTS</h4>
                        <div class="productsPage">
                            <!-- Products -->
                            <div class="products"></div>
                            <!-- Pagination -->
                            <div class="pagination">
                                <!-- <div class="page-item" id="previous">
                                    <div class="page-link"><<</div>
                                </div> -->
                                <div class="js_page_items">

                                </div>
                                <!-- <div class="page-item" id="next">
                                    <div class="page-link">>></div>
                                </div> -->
                            </div>
                            <!-- Products script -->
                            <script>
                                const productsPage = document.querySelector(".products");

                                async function fetchProducts() {
                                    const productsPerPage = window.innerWidth < 992 ? 10 : 20;

                                    const response = await fetch("./backend/json_datas/products.php");
                                    const data = await response.json();

                                    const paginationContainer = document.querySelector(
                                        ".productsPage .pagination .js_page_items"
                                    );

                                    paginationContainer.innerHTML = "";

                                    function renderProducts(startIndex) {
                                        let html = "";

                                        const endIndex = startIndex + productsPerPage;

                                        for (let i = startIndex; i < endIndex; i++) {

                                            if (data.length < 1) {
                                                html = `
                                                <div style="width: 100%; display: flex; justify-content: center; align-items: center; flex: 1;">Currently out of stocks</div>
                                                `;
                                            } else {
                                                const product = data[i];

                                                html += `
                                                <div class="productCard">
                                                    <div class="container">
                                                        <img src="${product.image}" alt="">
                                                        <div class="product-details">
                                                            <h3 class="title">${product.name}</h3>

                                                            <span>
                                                                Price: ${product.currency}
                                                                <span class="price">${product.price}</span>
                                                            </span>

                                                            <div class="quantity">
                                                                <button class="quantity-remover">-</button>
                                                                <button class="quantity-number">1</button>
                                                                <button class="quantity-adder">+</button>
                                                            </div>

                                                            <p>
                                                                Number in stock:
                                                                <b class="number-in-stock">${product["number-in-stock"]}</b>
                                                            </p>

                                                            <div class="add-to-cart">
                                                                <button>Add to Cart</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            `;
                                            }


                                        }

                                        productsPage.innerHTML = html;
                                        attachQuantityHandlers();
                                    }

                                    function attachQuantityHandlers() {
                                        const products = document.querySelectorAll(".products .productCard");

                                        products.forEach(product => {
                                            const adder = product.querySelector(".quantity-adder");
                                            const remover = product.querySelector(".quantity-remover");
                                            const qtyNumber = product.querySelector(".quantity-number");
                                            const priceEl = product.querySelector(".price");
                                            const stockEl = product.querySelector(".number-in-stock");

                                            let quantity = 1;
                                            const unitPrice = parseInt(priceEl.innerText);
                                            const stock = parseInt(stockEl.innerText);

                                            adder.addEventListener("click", () => {
                                                if (quantity < stock) {
                                                    quantity++;
                                                    qtyNumber.innerText = quantity;
                                                    priceEl.innerText = unitPrice * quantity;
                                                }
                                            });

                                            remover.addEventListener("click", () => {
                                                if (quantity > 1) {
                                                    quantity--;
                                                    qtyNumber.innerText = quantity;
                                                    priceEl.innerText = unitPrice * quantity;
                                                }
                                            });
                                        });
                                    }

                                    /* ---------- PAGINATION ---------- */

                                    const totalPages = Math.ceil(data.length / productsPerPage);

                                    for (let p = 0; p < totalPages; p++) {
                                        const pageItem = document.createElement("div");
                                        pageItem.className = "page-item";
                                        pageItem.innerHTML = `<div class="page-link">${p + 1}</div>`;

                                        pageItem.addEventListener("click", () => {
                                            renderProducts(p * productsPerPage);

                                            document
                                                .querySelectorAll(".page-item")
                                                .forEach(el => el.classList.remove("active"));

                                            pageItem.classList.add("active");
                                        });

                                        paginationContainer.appendChild(pageItem);
                                    }

                                    /* ---------- INITIAL LOAD ---------- */
                                    renderProducts(0);
                                    paginationContainer.firstChild.classList.add("active");
                                }

                                fetchProducts();
                            </script>
                            <!-- Add to cart script -->
                            <script>
                                function addToCart() {
                                    const products = document.querySelectorAll(".products .productCard");
                                    products.forEach(product => {
                                        const productData = new FormData();
                                        productData.append();
                                        productData.append();
                                    })
                                }
                            </script>
                        </div>
                    </div>
                </div>
                <!-- Categories Page -->
                <div data-page="categories">Categories</div>
                <div data-page="cart">Cart</div>
                <!-- Homepage Ends -->
            </div>
        </div>
        <!-- Foot Menu Space in the page -->
        <div style="height: 10vh"></div>
        <!-- Foot Menu's Relationship with pages -->
        <script>
            const footMenus = document.querySelectorAll("[data-foot-nav]")
            const pages = document.querySelectorAll("[data-page]")
            // Default page[Homepage]
            for (i = 1; i < pages.length; i++) {
                pages.item(i).classList.add("d-none")
            }
            // All footmenus on click
            footMenus.forEach(footMenu => {
                footMenu.addEventListener("click", function() {
                    const menuPage = document.querySelector(`[data-page="${footMenu.getAttribute("data-foot-nav")}"]`);
                    for (i = 0; i < pages.length; i++) {
                        pages.item(i).classList.add("d-none")
                    }
                    menuPage.classList.remove("d-none")
                })
            })
        </script>
    </div>
</body>

</html>