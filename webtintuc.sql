-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 02, 2024 lúc 05:54 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `webtintuc`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lienhe`
--

CREATE TABLE `lienhe` (
  `id` int(11) NOT NULL,
  `tenkhachhang` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `sodienthoai` varchar(255) NOT NULL,
  `loaisanpham` varchar(255) NOT NULL,
  `noidung` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `lienhe`
--

INSERT INTO `lienhe` (`id`, `tenkhachhang`, `email`, `sodienthoai`, `loaisanpham`, `noidung`) VALUES
(20, 'Yến', 'yenconguyet@gmail.com', '0898976599', 'Tủ Thần Tài', 'mua nữa đê '),
(22, 'Tiên', 'ngothimytien14072003@gmail.com', '0898765799', 'Bục', 'Tiên '),
(23, 'Yến', 'yenconguyet@gmail.com', '0987654499', 'Tủ Thần Tài', 'Mua mua mua'),
(24, 'CHi', 'zhongli3112521@gmail.com', '0898765799', 'Bục', 'A Li'),
(25, 'A Li', 'conguyet3121@gmail.com', '0987654499', 'Bục', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaa'),
(31, 'Yen', 'yenconguyet@gmail.com', '0898765799', 'Tủ Thần Tài', 'Mợt quá'),
(32, 'LI', 'zhongli3112521@gmail.com', '0898976599', 'Bục', 'LI'),
(33, 'Nị', 'thainhi0701@gmail.com', '0898976599', 'Tủ Thờ', 'Nị');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ngaysinh` date DEFAULT current_timestamp(),
  `email` varchar(255) DEFAULT NULL,
  `sodienthoai` varchar(255) NOT NULL,
  `diachi` varchar(255) NOT NULL,
  `ngaydangky` timestamp NOT NULL DEFAULT current_timestamp(),
  `dangnhap` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `login`
--

INSERT INTO `login` (`id`, `username`, `password`, `ngaysinh`, `email`, `sodienthoai`, `diachi`, `ngaydangky`, `dangnhap`) VALUES
(2, 'Zhongli', 'Zhongli3112', '2024-04-01', 'zhongli3112521@gmail.com', '0987654329', 'TV', '2024-04-29 19:39:35', 3),
(3, 'Hải Yến', 'Haiyen2105', '2024-04-19', 'yenconguyet@gmail.com', '0839952469', 'VN', '2024-04-29 19:41:34', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `loainame` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `image2` varchar(255) NOT NULL,
  `image3` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `chatlieu` varchar(255) NOT NULL,
  `baohanh` varchar(255) NOT NULL,
  `mota` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `loainame`, `image`, `image2`, `image3`, `price`, `description`, `created_at`, `chatlieu`, `baohanh`, `mota`) VALUES
(4, 'Bục - B01', 'Bục', 'buc1.jpg', 'Buc1_1.jpg', 'Buc1_2.jpg', '[Liên Hệ]', 'Công Ty TNHH MTV TRÚC ANH', '2024-04-12 20:53:48', 'Gõ Đỏ', '12 tháng', '<p style=\"padding-left: 40px;\"><span style=\"font-size: 18pt;\">&rArr; &bull; <span style=\"color: #843fa1;\"><strong>Bục ph&aacute;t biểu&nbsp;</strong></span>được l&agrave;m&nbsp;bằng &nbsp;inox , th&eacute;p phun sơn tĩnh điện, thiết kế nhỏ gọn dễ di chuyển</span></p>\r\n<p style=\"padding-left: 40px;\"><span style=\"font-size: 18pt;\">&bull; Bục được thiết kế hiện đại vừa tầm người đứng, c&oacute; bề mặt rộng thuận tiện cho việc để m&aacute;y t&iacute;nh thuyết tr&igrave;nh, tr&igrave;nh b&agrave;y v&agrave; diễn thuyết đọc ph&aacute;t biểu tại c&aacute;c cuộc họp, hội nghị..</span></p>'),
(10, 'Tủ Thần Tài - TTT01', 'Tủ Thần Tài', 'tuthantai1.jpg', 'tuthantai1_2.jpg', 'tuthantai1_1.jpg', '[Liên Hệ]', 'Công Ty TNHH MTV TRÚC ANH', '2024-04-22 19:57:38', 'Gõ Đỏ', '12 tháng', '<p style=\"line-height: 1.2; padding-left: 40px; text-align: justify;\"><span style=\"font-size: 14pt;\"><span style=\"color: #ba372a; font-size: 18pt;\">&rArr;&nbsp;<strong>Tủ</strong></span> được kết hợp c&aacute;c yếu tố phong thủy với nhau, nhằm mang đến sự thịnh vượng v&agrave; t&agrave;i lộc tốt nhất cho qu&yacute; kh&aacute;ch, d&agrave;nh cho kh&aacute;ch th&iacute;ch độc, lạ, chạm khắc nhiều, t&ocirc;n l&ecirc;n vẻ trang nghi&ecirc;m cho kh&ocirc;ng gian thờ c&uacute;ng</span></p>'),
(11, 'Tủ Thờ - TT01', 'Tủ Thờ', 'tutho1.jpg', 'card2.jpg', 'card1.jpg', '[Liên Hệ]', 'Công Ty TNHH MTV TRÚC ANH', '2024-04-25 19:43:56', 'Cẩm Lai', '12 tháng', '<p>Tủ Thờ</p>'),
(12, 'Tủ Thờ - TT02', 'Tủ Thờ', 'tutho2.jpg', 'tutho2-1.jpg', 'tutho2-2.jpg', '[Liên Hệ]', 'Công Ty TNHH MTV TRÚC ANH', '2024-04-29 23:10:49', 'Cẩm Lai', '12 tháng', '<p style=\"padding-left: 40px;\"><span style=\"font-size: 14pt;\"><span style=\"font-size: 18pt; color: #580101;\"><strong>Gỗ cẩm lai:</strong></span> Tại Việt Nam được xếp v&agrave;o nh&oacute;m 1. </span></p>\r\n<p style=\"padding-left: 40px;\"><span style=\"font-size: 14pt;\"><strong>Gỗ Cẩm Lai</strong> kh&aacute; đẹp, c&oacute; m&ugrave;i thơm nhẹ, cứng, v&acirc;n hoa đẹp, &iacute;t nứt nẻ, kh&ocirc;ng bị mối mọt. </span></p>\r\n<p style=\"padding-left: 40px;\"><span style=\"font-size: 14pt;\"><strong>Gỗ Cẩm Lai</strong> sở hữu đường v&acirc;n m&agrave;u n&acirc;u hồng v&ocirc; c&ugrave;ng sắc n&eacute;t. Bố cục th&igrave; thi&ecirc;n biến vạn h&oacute;a. Mật độ v&acirc;n d&agrave;y v&agrave; mịn. Lớp ngo&agrave;i gỗ c&oacute; m&agrave;u v&agrave;ng cam nhạt. C&agrave;ng v&agrave;o gần phần l&otilde;i gỗ c&agrave;ng sẫm m&agrave;u hơn (n&acirc;u) tối hơn b&ecirc;n ngo&agrave;i. Nếu so về mặt thẩm mỹ th&igrave; đẹp kh&ocirc;ng thua k&eacute;m g&igrave; hương v&acirc;n. Thậm ch&iacute; c&ograve;n được nhiều người y&ecirc;u th&iacute;ch hơn do chất gỗ đặc, nặng, c&oacute; m&ugrave;i thơm nhẹ. M&agrave;u Gỗ Cẩm Lai c&oacute; sức hấp dẫn tuyệt đối với những ai y&ecirc;u th&iacute;ch gỗ m&agrave;u s&aacute;ng. Khi d&ugrave;ng được một thời gian sẽ l&ecirc;n m&agrave;u nh&igrave;n ng&agrave;y c&agrave;ng đẹp.</span></p>'),
(13, 'Chân Bàn - CB01', 'Chân Bàn', 'chanban1.jpg', 'chanban1-1.jpg', 'chanban1-2.jpg', '[Liên Hệ]', 'Công Ty TNHH MTV TRÚC ANH', '2024-04-29 23:18:17', 'Gõ Đỏ', '12 tháng', '<p style=\"padding-left: 40px;\"><span style=\"font-size: 14pt;\"><span style=\"font-size: 18pt; color: #1c0050;\"><strong>Ch&acirc;n b&agrave;n gỗ</strong> </span>c&oacute; đặc điểm l&agrave; mỗi ch&acirc;n b&agrave;n được đi&ecirc;u khắc một vẻ đẹp ri&ecirc;ng kh&aacute;c nhau kh&ocirc;ng đụng h&agrave;ng v&agrave; c&oacute; độ bền cao. N&ecirc;n ch&acirc;n b&agrave;n gỗ đ&atilde; trở th&agrave;nh xu hướng trong trang tr&iacute; nội thất ng&agrave;y nay v&agrave; được đa số người ti&ecirc;u d&ugrave;ng t&igrave;m kiếm.</span></p>'),
(14, 'Bàn Thờ - BT01', 'Bàn Thờ', 'bantho1.jpg', 'Dantuong.jpg', 'bantho1.jpg', '[Liên Hệ]', 'Công Ty TNHH MTV TRÚC ANH', '2024-04-30 00:11:04', 'Gõ Đỏ', '12 tháng', '<p>B&agrave;n Thờ</p>');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vechungtoi`
--

CREATE TABLE `vechungtoi` (
  `id` int(11) NOT NULL,
  `tennoidung` varchar(255) NOT NULL,
  `noidung` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `vechungtoi`
--

INSERT INTO `vechungtoi` (`id`, `tennoidung`, `noidung`, `created_at`) VALUES
(9, 'Công Ty Trúc Anh', '<p style=\"text-align: center;\"><span style=\"color: #580101; font-size: 24pt;\"><strong>C&ocirc;ng Ty Tr&uacute;c Anh</strong></span></p>\r\n<p><span style=\"font-size: 14pt;\">Ch&agrave;o mừng bạn đến với c&ocirc;ng ty trang tr&iacute; nội thất của ch&uacute;ng t&ocirc;i - nơi nơi mọi kh&ocirc;ng gian được biến h&oacute;a th&agrave;nh những tuyệt t&aacute;c sống động v&agrave; đẹp mắt. Ch&uacute;ng t&ocirc;i l&agrave; đội ngũ c&aacute;c chuy&ecirc;n gia s&aacute;ng tạo v&agrave; đam m&ecirc;, cam kết mang đến cho kh&aacute;ch h&agrave;ng những trải nghiệm trang tr&iacute; độc đ&aacute;o v&agrave; đ&aacute;ng nhớ.</span></p>\r\n<p><span style=\"font-size: 14pt;\">Tại c&ocirc;ng ty của ch&uacute;ng t&ocirc;i, ch&uacute;ng t&ocirc;i kh&ocirc;ng chỉ đơn thuần l&agrave; những người trang tr&iacute; nội thất, m&agrave; c&ograve;n l&agrave; những nh&agrave; tạo mẫu kh&ocirc;ng gian sống. Ch&uacute;ng t&ocirc;i hiểu r&otilde; rằng mỗi ng&ocirc;i nh&agrave; l&agrave; một c&acirc;u chuyện ri&ecirc;ng, v&agrave; ch&uacute;ng t&ocirc;i lu&ocirc;n t&ocirc;n trọng v&agrave; thấu hiểu nhu cầu cũng như phong c&aacute;ch sống của từng kh&aacute;ch h&agrave;ng. Với sự tận t&acirc;m v&agrave; s&aacute;ng tạo kh&ocirc;ng ngừng, ch&uacute;ng t&ocirc;i lu&ocirc;n nỗ lực để tạo ra những kh&ocirc;ng gian sống độc đ&aacute;o, phản &aacute;nh t&iacute;nh c&aacute;ch v&agrave; phong c&aacute;ch ri&ecirc;ng biệt của từng gia đ&igrave;nh.</span></p>\r\n<p><span style=\"font-size: 14pt;\">Chất lượng l&agrave; ti&ecirc;u ch&iacute; h&agrave;ng đầu tại c&ocirc;ng ty của ch&uacute;ng t&ocirc;i. Ch&uacute;ng t&ocirc;i sử dụng những vật liệu v&agrave; sản phẩm chất lượng cao, kết hợp với sự tinh tế trong thiết kế v&agrave; sự kh&eacute;o l&eacute;o trong thực hiện để đảm bảo mỗi dự &aacute;n đều vượt qua mong đợi của kh&aacute;ch h&agrave;ng.</span></p>\r\n<p><span style=\"font-size: 14pt;\">D&ugrave; bạn đang t&igrave;m kiếm một phong c&aacute;ch trang tr&iacute; hiện đại, cổ điển, hoặc đậm chất c&aacute; nh&acirc;n, ch&uacute;ng t&ocirc;i lu&ocirc;n sẵn l&ograve;ng hỗ trợ bạn. H&atilde;y để ch&uacute;ng t&ocirc;i biến ước mơ của bạn về một kh&ocirc;ng gian sống l&yacute; tưởng th&agrave;nh hiện thực, một kh&ocirc;ng gian m&agrave; bạn sẽ tự h&agrave;o gọi l&agrave; \"nh&agrave;\".</span></p>\r\n<p><span style=\"font-size: 14pt;\">H&atilde;y đồng h&agrave;nh c&ugrave;ng ch&uacute;ng t&ocirc;i để tạo n&ecirc;n những kh&ocirc;ng gian sống đẹp đẽ v&agrave; ấm &aacute;p, nơi m&agrave; bạn c&oacute; thể tận hưởng mỗi khoảnh khắc của cuộc sống!</span></p>', '2024-04-30 23:56:50'),
(10, 'Công Ty Trúc Anh', '<p style=\"text-align: center;\"><span style=\"color: #580101; font-size: 24pt;\"><strong>C&ocirc;ng Ty Tr&uacute;c Anh</strong></span></p>\r\n<p><span style=\"font-size: 14pt;\">Ch&agrave;o mừng bạn đến với c&ocirc;ng ty trang tr&iacute; nội thất của ch&uacute;ng t&ocirc;i - nơi nơi mọi kh&ocirc;ng gian được biến h&oacute;a th&agrave;nh những tuyệt t&aacute;c sống động v&agrave; đẹp mắt. Ch&uacute;ng t&ocirc;i l&agrave; đội ngũ c&aacute;c chuy&ecirc;n gia s&aacute;ng tạo v&agrave; đam m&ecirc;, cam kết mang đến cho kh&aacute;ch h&agrave;ng những trải nghiệm trang tr&iacute; độc đ&aacute;o v&agrave; đ&aacute;ng nhớ.</span></p>\r\n<p><span style=\"font-size: 14pt;\">Tại c&ocirc;ng ty của ch&uacute;ng t&ocirc;i, ch&uacute;ng t&ocirc;i kh&ocirc;ng chỉ đơn thuần l&agrave; những người trang tr&iacute; nội thất, m&agrave; c&ograve;n l&agrave; những nh&agrave; tạo mẫu kh&ocirc;ng gian sống. Ch&uacute;ng t&ocirc;i hiểu r&otilde; rằng mỗi ng&ocirc;i nh&agrave; l&agrave; một c&acirc;u chuyện ri&ecirc;ng, v&agrave; ch&uacute;ng t&ocirc;i lu&ocirc;n t&ocirc;n trọng v&agrave; thấu hiểu nhu cầu cũng như phong c&aacute;ch sống của từng kh&aacute;ch h&agrave;ng. Với sự tận t&acirc;m v&agrave; s&aacute;ng tạo kh&ocirc;ng ngừng, ch&uacute;ng t&ocirc;i lu&ocirc;n nỗ lực để tạo ra những kh&ocirc;ng gian sống độc đ&aacute;o, phản &aacute;nh t&iacute;nh c&aacute;ch v&agrave; phong c&aacute;ch ri&ecirc;ng biệt của từng gia đ&igrave;nh.</span></p>\r\n<p><span style=\"font-size: 14pt;\">Chất lượng l&agrave; ti&ecirc;u ch&iacute; h&agrave;ng đầu tại c&ocirc;ng ty của ch&uacute;ng t&ocirc;i. Ch&uacute;ng t&ocirc;i sử dụng những vật liệu v&agrave; sản phẩm chất lượng cao, kết hợp với sự tinh tế trong thiết kế v&agrave; sự kh&eacute;o l&eacute;o trong thực hiện để đảm bảo mỗi dự &aacute;n đều vượt qua mong đợi của kh&aacute;ch h&agrave;ng.</span></p>\r\n<p><span style=\"font-size: 14pt;\">D&ugrave; bạn đang t&igrave;m kiếm một phong c&aacute;ch trang tr&iacute; hiện đại, cổ điển, hoặc đậm chất c&aacute; nh&acirc;n, ch&uacute;ng t&ocirc;i lu&ocirc;n sẵn l&ograve;ng hỗ trợ bạn. H&atilde;y để ch&uacute;ng t&ocirc;i biến ước mơ của bạn về một kh&ocirc;ng gian sống l&yacute; tưởng th&agrave;nh hiện thực, một kh&ocirc;ng gian m&agrave; bạn sẽ tự h&agrave;o gọi l&agrave; \"nh&agrave;\".</span></p>\r\n<p><span style=\"font-size: 14pt;\">H&atilde;y đồng h&agrave;nh c&ugrave;ng ch&uacute;ng t&ocirc;i để tạo n&ecirc;n những kh&ocirc;ng gian sống đẹp đẽ v&agrave; ấm &aacute;p, nơi m&agrave; bạn c&oacute; thể tận hưởng mỗi khoảnh khắc của cuộc sống!</span></p>', '2024-04-30 23:58:15');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `lienhe`
--
ALTER TABLE `lienhe`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`,`username`,`password`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `hoten` (`username`),
  ADD KEY `matkhau` (`password`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `image` (`image`),
  ADD KEY `price` (`price`);

--
-- Chỉ mục cho bảng `vechungtoi`
--
ALTER TABLE `vechungtoi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `lienhe`
--
ALTER TABLE `lienhe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT cho bảng `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `vechungtoi`
--
ALTER TABLE `vechungtoi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
