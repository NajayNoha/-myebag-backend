
-- Category Types
INSERT INTO product_category (`id`, `name`, `desc`, `created_at`, `modified_at`, `deleted_at`) VALUES 
(1, 'shoes', 'Collection of different types of Shoes.', '2022-11-01 00:00:00', NULL, NULL),
(2, 'hoodies', 'Collection of different types of Hoodies.', '2022-11-01 00:00:00', NULL, NULL),
(3, 'watches', 'Collection of different types of Watches.', '2022-11-01 00:00:00', NULL, NULL);


-- User Types

INSERT INTO user_type (id, user_type) VALUES
(1, 'Admin'),
(2, 'User');


-- Test Products

---- Shoes 

INSERT INTO `product`(`id`, `name`, `desc`, `SKU`, `category_id`, `price`, `discount_id`, `created_at`, `modified_at`, `deleted_at`) VALUES 

(1, "Nike Off-White x Air Jordan 1 Retro High OG 'UNC'", "Virgil Abloh team up with Nike deconstructed the Air Jordan 1 High that featured the iconic UNC colour. The Nike x OffWhite Air Jordan 1 series attracts a massive amount of attention and sell out instantly.","air-jordan-1-retro-high-og", 1, 200, NULL, CURRENT_DATE(), NULL, NULL),


(2 ,"Air Jordan 5 Retro 'Racer Blue'", 
"Signature mesh profile windows and reflective tops of tongues deviate from their stealthy surroundings in shades of silver, with the latter components also featuring detailing in the titular “Racer Blue” tone.", 'air-jordan-2-retro-racer-blue', 1, 120, NULL, CURRENT_DATE(), NULL, NULL),


(3, "Air Jordan 1 Zoom Air CMFT Womens Light Violet", "This Air Jordan 1 Zoom Comfort 'Easter' has been constructed in a pastel color hue that is inspired by the Easter eggs themselves. It features a cream-colored tumbled leather serving as the base of the upper while purple and pink leather overlays appear at the forefoot and light green accents appear on the heel counter and ankle collar. The Swoosh is made of mesh. The Jumpman logo is embossed, the black laces and tongue add further contrast, while the white covers the opaque sole edged with a beautiful semi-translucent rubber completes the design.", "air-jordan-1-zoom-air-cmft-light-violet", 1, 220, NULL, CURRENT_DATE(), NULL, NULL),


(4, "Air Jordan 5 Retro 'Raging Bull' 2021", "This Nike Air Jordan 5 Retro 'Raging Bull' features a plush Varsity Red suede upper, equipped with black eyelets and a Jumpman-branded reflective silver tongue. The black midsoles and insignia dress atop, icy blue soles hit the underside of the tooling, and the signature “23” stamps near the heel complete the design.",'air-jordan-5-retro-raging-bull-2021',1, 300, NULL, CURRENT_DATE(), NULL, NULL);

INSERT INTO images (id_product, link_image, order_image) VALUES
 
(1, '/images/products/shoes/1/1.webp', 1),
(1, '/images/products/shoes/1/2.webp', 2),
(1, '/images/products/shoes/1/3.webp', 3),

(2, '/images/products/shoes/2/1.webp', 1),
(2, '/images/products/shoes/2/2.webp', 2),
(2, '/images/products/shoes/2/3.webp', 3),

(3, '/images/products/shoes/3/1.webp', 1),
(3, '/images/products/shoes/3/2.webp', 2),
(3, '/images/products/shoes/3/3.webp', 3),

(4, '/images/products/shoes/4/1.webp', 1),
(4, '/images/products/shoes/4/2.webp', 2),
(4, '/images/products/shoes/4/3.webp', 3);



--- hoodies

INSERT INTO `product`(id, `name`, `desc`, `SKU`, `category_id`, `price`, `discount_id`, `created_at`, `modified_at`, `deleted_at`) VALUES 

(5, "Butter Goods Orchard Pullover Hoody - Cream", "Butter Goods' Orchard Hoody is a pullover style piece made from a heavyweight, 100% cotton. It features a seasonal graphic and classic Butter logo printed to the chest, along with drawstring hood, kangaroo pouch and ribbed trims.", "butter-goods-orchard-pullover-hoody-cream", 2, 105, NULL, CURRENT_DATE(), NULL, NULL),

(6, "Obey Step Hoody - Black", "Constructed from a cotton/polyester blend fleece, the Step Hoody by Obey features one of their seasonal graphics, embroidered front and centre. Also present is a drawstring hood, ribbed trims and kangaroo pouch.", "obey-step-hoody-black", 2, 105, NULL, CURRENT_DATE(), NULL, NULL),

(7, "Pleasures Suffering Hoody - Black", "With oversized embroidery, the Pleasures Suffering Hoody comes in a heavyweight cotton poly blend. Featuring a large scale seasonal embroidered piece to the front alongside the Pleasures logo. The hoody is finished with ribbed cuffs and hem and a kangaroo pocket.", "pleasures-suffering-hoody-black", 2, 105, NULL, CURRENT_DATE(), NULL, NULL),

(8, "Pleasures Blurry Hoody - Sand", "The Pleasures Blurry Hoody comes in a heavyweight cotton/poly blend. Featuring a printed logo to the front, the hoody is finished with ribbed cuffs and hem, drawstring hood and a kangaroo pocket.", "pleasures-blurry-hoody-sand", 2, 105, NULL, CURRENT_DATE(), NULL, NULL);


INSERT INTO images (id_product, link_image, order_image) VALUES
 
(5, '/images/products/hoodies/5/1.webp', 1),
(5, '/images/products/hoodies/5/2.webp', 2),

(6, '/images/products/hoodies/6/1.webp', 1),
(6, '/images/products/hoodies/6/2.webp', 2),

(7, '/images/products/hoodies/7/1.webp', 1),
(7, '/images/products/hoodies/7/2.webp', 2),

(8, '/images/products/hoodies/8/1.webp', 1),
(8, '/images/products/hoodies/8/2.jpg', 2);


--- watches

INSERT INTO `product`(id, `name`, `desc`, `SKU`, `category_id`, `price`, `discount_id`, `created_at`, `modified_at`, `deleted_at`) VALUES 

(9, "Ladies Olivia Burton Mermaid Tail Watch", "If you’ve always wanted to channel some mermaid vibes, here’s how. As you can probably tell, Olivia Burton must have had a lot of fun designing this mermaid-tail inspired timepiece. A shimmery rainbow of scalloped scales adorns the bold Demi dial, all set off by contemporary silver casing and mesh strap. This is guaranteed to bring a smile every time you look down at your wrist.", "ladies-olivia-burton-mermaid-tail", 3, 123, NULL, CURRENT_DATE(), NULL, NULL),

(10, "Mens Lacoste Watch", "Lacoste 2011050 is an amazing and attractive Gents watch from Heritage collection. Case is made out of Stainless Steel while the dial colour is White. In regards to the water resistance, the watch has got a resistancy up to 50 metres. It means it can be submerged in water for periods, so can be used for swimming and fishing. It is not recommended for high impact water sports. We ship it with an original box and a guarantee from the manufacturer.", "mens-lacoste-watch", 3, 120, NULL, CURRENT_DATE(), NULL, NULL),

(11, "Mens Accurist Chronograph Watch", "A versatile and innovative chronograph from Accurist, bringing fun and flavour to a sensible and functional design.

It’s much more than the yellow dial which makes this new offering from the English manufacturers a style leader, although the yellow is hard to ignore! Rather than dominate the look of the watch, it sits beautifully alongside the white hands (which are outlined in black), providing a stark contrast yet achieving a modern look and feel.

The black stainless steel strap (which we will resize for free) adds the layer of elegance and sophistication which brings together these clashes of style into one cohesive and timeless watch. You wouldn’t normally expect to see such a vibrant and playful watch as a chronograph, but you can here you can enjoy all the benefits that a stopwatch and an independent sweep second hand add to this unique piece.", "mens-accurist-chronograph-watch", 3, NULL, 130, CURRENT_DATE(), NULL, NULL),

(12, "Mens HUGO #Seek Watch", "HUGO #Seek 1530151 is an amazing and special Gents watch from #Seek collection. Case material is Stainless Steel, which stands for a high quality of the item while the dial colour is Black. In regards to the water resistance, the watch is marked as water resistant to 30 metres. This means it can be worn in scenarios where it is likely to be splashed but not immersed in water. It can be worn while washing your hands and will be fine in rain. The watch is shipped with an original box and a guarantee from the manufacturer.", "mens-hugo-seek-watch", 3, 150, NULL, CURRENT_DATE(), NULL, NULL);


INSERT INTO images (id_product, link_image, order_image) VALUES
 
(9, '/images/products/watches/9/1.jpg', 1),
(9, '/images/products/watches/9/2.jpg', 2),
(9, '/images/products/watches/9/3.jpg', 3),

(10, '/images/products/watches/10/1.jpg', 1),
(10, '/images/products/watches/10/2.jpg', 2),

(11, '/images/products/watches/11/1.webp', 1),
(11, '/images/products/watches/11/2.jpg', 2),
(11, '/images/products/watches/11/3.webp', 3),

(12, '/images/products/watches/12/1.webp', 1),
(12, '/images/products/watches/12/2.jpg', 2),
(12, '/images/products/watches/12/3.jpg', 3);
