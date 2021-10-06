USE [e-business]
GO
SET IDENTITY_INSERT [dbo].[permissions] ON 

INSERT [dbo].[permissions] ([id], [name], [guard_name], [created_at], [updated_at]) VALUES (1, N'admin.category', N'web', CAST(N'2021-08-28T17:52:40.627' AS DateTime), CAST(N'2021-08-28T17:52:40.627' AS DateTime))
INSERT [dbo].[permissions] ([id], [name], [guard_name], [created_at], [updated_at]) VALUES (2, N'admin.product', N'web', CAST(N'2021-08-28T17:52:40.673' AS DateTime), CAST(N'2021-08-28T17:52:40.673' AS DateTime))
INSERT [dbo].[permissions] ([id], [name], [guard_name], [created_at], [updated_at]) VALUES (3, N'admin.product.photo', N'web', CAST(N'2021-08-28T17:52:40.687' AS DateTime), CAST(N'2021-08-28T17:52:40.687' AS DateTime))
INSERT [dbo].[permissions] ([id], [name], [guard_name], [created_at], [updated_at]) VALUES (4, N'admin.coupon', N'web', CAST(N'2021-08-28T17:52:40.697' AS DateTime), CAST(N'2021-08-28T17:52:40.697' AS DateTime))
INSERT [dbo].[permissions] ([id], [name], [guard_name], [created_at], [updated_at]) VALUES (5, N'admin.user', N'web', CAST(N'2021-08-28T17:52:40.707' AS DateTime), CAST(N'2021-08-28T17:52:40.707' AS DateTime))
INSERT [dbo].[permissions] ([id], [name], [guard_name], [created_at], [updated_at]) VALUES (6, N'admin.order', N'web', CAST(N'2021-08-28T17:52:40.720' AS DateTime), CAST(N'2021-08-28T17:52:40.720' AS DateTime))
INSERT [dbo].[permissions] ([id], [name], [guard_name], [created_at], [updated_at]) VALUES (7, N'admin.cash.register', N'web', CAST(N'2021-08-28T17:52:40.730' AS DateTime), CAST(N'2021-08-28T17:52:40.730' AS DateTime))
SET IDENTITY_INSERT [dbo].[permissions] OFF
GO
SET IDENTITY_INSERT [dbo].[roles] ON 

INSERT [dbo].[roles] ([id], [name], [guard_name], [created_at], [updated_at]) VALUES (1, N'Admin', N'web', CAST(N'2021-08-28T17:52:40.587' AS DateTime), CAST(N'2021-08-28T17:52:40.587' AS DateTime))
INSERT [dbo].[roles] ([id], [name], [guard_name], [created_at], [updated_at]) VALUES (2, N'Cliente', N'web', CAST(N'2021-08-28T17:52:40.593' AS DateTime), CAST(N'2021-08-28T17:52:40.593' AS DateTime))
SET IDENTITY_INSERT [dbo].[roles] OFF
GO
INSERT [dbo].[role_has_permissions] ([permission_id], [role_id]) VALUES (1, 1)
INSERT [dbo].[role_has_permissions] ([permission_id], [role_id]) VALUES (2, 1)
INSERT [dbo].[role_has_permissions] ([permission_id], [role_id]) VALUES (3, 1)
INSERT [dbo].[role_has_permissions] ([permission_id], [role_id]) VALUES (4, 1)
INSERT [dbo].[role_has_permissions] ([permission_id], [role_id]) VALUES (5, 1)
INSERT [dbo].[role_has_permissions] ([permission_id], [role_id]) VALUES (6, 1)
INSERT [dbo].[role_has_permissions] ([permission_id], [role_id]) VALUES (7, 1)
GO
INSERT [dbo].[model_has_roles] ([role_id], [model_type], [model_id]) VALUES (1, N'App\Models\User', 1)
INSERT [dbo].[model_has_roles] ([role_id], [model_type], [model_id]) VALUES (1, N'App\Models\User', 2)
INSERT [dbo].[model_has_roles] ([role_id], [model_type], [model_id]) VALUES (2, N'App\Models\User', 3)
INSERT [dbo].[model_has_roles] ([role_id], [model_type], [model_id]) VALUES (2, N'App\Models\User', 4)
INSERT [dbo].[model_has_roles] ([role_id], [model_type], [model_id]) VALUES (2, N'App\Models\User', 5)
INSERT [dbo].[model_has_roles] ([role_id], [model_type], [model_id]) VALUES (2, N'App\Models\User', 6)
INSERT [dbo].[model_has_roles] ([role_id], [model_type], [model_id]) VALUES (2, N'App\Models\User', 7)
INSERT [dbo].[model_has_roles] ([role_id], [model_type], [model_id]) VALUES (2, N'App\Models\User', 8)
INSERT [dbo].[model_has_roles] ([role_id], [model_type], [model_id]) VALUES (2, N'App\Models\User', 9)
GO
SET IDENTITY_INSERT [dbo].[coupon] ON 

INSERT [dbo].[coupon] ([id], [code], [discount], [type], [date_start], [date_end], [stock], [created_at], [updated_at], [deleted_at]) VALUES (1, N'C0001', CAST(15.00 AS Decimal(10, 2)), N'Porcentaje', CAST(N'2021-08-11' AS Date), CAST(N'2021-11-22' AS Date), 296, CAST(N'2021-08-29T03:59:49.250' AS DateTime), CAST(N'2021-09-26T15:52:00.543' AS DateTime), NULL)
INSERT [dbo].[coupon] ([id], [code], [discount], [type], [date_start], [date_end], [stock], [created_at], [updated_at], [deleted_at]) VALUES (3, N'C0002', CAST(25.00 AS Decimal(10, 2)), N'Fijo', CAST(N'2021-06-17' AS Date), CAST(N'2021-10-21' AS Date), 197, CAST(N'2021-08-29T07:04:53.130' AS DateTime), CAST(N'2021-09-26T16:06:02.183' AS DateTime), NULL)
SET IDENTITY_INSERT [dbo].[coupon] OFF
GO
SET IDENTITY_INSERT [dbo].[user] ON 

INSERT [dbo].[user] ([id], [name], [lastname], [email], [avatar], [password], [remember_token], [created_at], [updated_at], [deleted_at]) VALUES (1, N'Admin', N'Project', N'admin@admin.com', N'http://localhost:8000/img/user/1630215045-imagen_2021-08-29_003044.png', N'$2y$10$YgICrLvSW6OOWP/A2XEfCOEJbSnj3zWDYxcM3UAsN9FwRfqZ5clk6', NULL, CAST(N'2021-08-28T21:01:16.213' AS DateTime), CAST(N'2021-08-29T05:32:43.973' AS DateTime), NULL)
INSERT [dbo].[user] ([id], [name], [lastname], [email], [avatar], [password], [remember_token], [created_at], [updated_at], [deleted_at]) VALUES (2, N'Client', N'Account', N'csjoin99@gmail.com', NULL, N'$2y$10$.mGva.mPo77kwa7T9xNKg.CjonP6VS1ZLbzcYij230gPzmb081ry.', NULL, CAST(N'2021-08-28T21:04:12.497' AS DateTime), CAST(N'2021-08-29T04:48:28.790' AS DateTime), NULL)
INSERT [dbo].[user] ([id], [name], [lastname], [email], [avatar], [password], [remember_token], [created_at], [updated_at], [deleted_at]) VALUES (3, N'Test 1', N'Test', N'test@test.com', N'http://localhost:8000/img/user/1630204963-imagen_2021-08-28_214241.png', N'$2y$10$Q9gSFHMFE4opZqB.spxsRODuYS2n8wiiIrBXgVTpQIzbuRJ.tDZjm', NULL, CAST(N'2021-08-28T21:37:04.407' AS DateTime), CAST(N'2021-08-29T04:48:28.847' AS DateTime), NULL)
INSERT [dbo].[user] ([id], [name], [lastname], [email], [avatar], [password], [remember_token], [created_at], [updated_at], [deleted_at]) VALUES (6, N'delete 2', N'delete', N'delete@delete.com', NULL, N'$2y$10$JGjZzj8AMIxmgKnWSEcMEOdq.Y6NEtPjonNJLDxLasxp1lHocgowG', NULL, CAST(N'2021-09-08T05:04:30.150' AS DateTime), CAST(N'2021-09-08T05:04:43.723' AS DateTime), CAST(N'2021-09-08T05:04:43.723' AS DateTime))
INSERT [dbo].[user] ([id], [name], [lastname], [email], [avatar], [password], [remember_token], [created_at], [updated_at], [deleted_at]) VALUES (7, N'customer', N'customer', N'customer@customer.com', NULL, N'$2y$10$m0vUnGyGA5zot6pGqMnaUeWRPgESugrqfuqH6CC89h.Kj/ZUyNgMy', NULL, CAST(N'2021-09-23T05:43:55.550' AS DateTime), CAST(N'2021-09-23T05:43:55.550' AS DateTime), NULL)
INSERT [dbo].[user] ([id], [name], [lastname], [email], [avatar], [password], [remember_token], [created_at], [updated_at], [deleted_at]) VALUES (8, N'delete', N'delete', N'te@te.com', NULL, N'$2y$10$XgOtZ1qCr/o7niLKwHsJrOLnwpcUZYzkzVfZR070om.Qfmez2nX4u', NULL, CAST(N'2021-09-29T23:28:12.367' AS DateTime), CAST(N'2021-09-29T23:28:24.977' AS DateTime), NULL)
INSERT [dbo].[user] ([id], [name], [lastname], [email], [avatar], [password], [remember_token], [created_at], [updated_at], [deleted_at]) VALUES (9, N'eliminar', N'eliminar', N'eliminar@eliminar.com', NULL, N'$2y$10$h6KNMuBRwlBFXlwKWgXtl.0.wQfLavWTvWdk3k.useK/fsdfhuwOy', NULL, CAST(N'2021-09-30T20:22:33.850' AS DateTime), CAST(N'2021-09-30T20:22:33.850' AS DateTime), NULL)
SET IDENTITY_INSERT [dbo].[user] OFF
GO
SET IDENTITY_INSERT [dbo].[order] ON 

INSERT [dbo].[order] ([id], [user_id], [coupon_id], [code], [client], [shipment_date], [shipment_type], [shipment_price], [shipment_status], [shipment_hour], [address], [district], [reference], [total], [subtotal], [discount], [status], [created_at], [updated_at], [deleted_at]) VALUES (1, 3, 1, N'00001', NULL, CAST(N'2021-08-30' AS Date), N'Presencial', CAST(0.00 AS Decimal(10, 2)), 1, NULL, NULL, NULL, NULL, CAST(191.25 AS Decimal(10, 2)), CAST(225.00 AS Decimal(10, 2)), CAST(33.75 AS Decimal(10, 2)), 3, CAST(N'2021-08-30T17:40:07.077' AS DateTime), CAST(N'2021-08-30T18:52:31.103' AS DateTime), CAST(N'2021-08-30T18:52:31.103' AS DateTime))
INSERT [dbo].[order] ([id], [user_id], [coupon_id], [code], [client], [shipment_date], [shipment_type], [shipment_price], [shipment_status], [shipment_hour], [address], [district], [reference], [total], [subtotal], [discount], [status], [created_at], [updated_at], [deleted_at]) VALUES (2, NULL, NULL, N'00002', N'Nuevo cliente', CAST(N'2021-08-30' AS Date), N'Presencial', CAST(0.00 AS Decimal(10, 2)), 1, NULL, NULL, NULL, NULL, CAST(425.00 AS Decimal(10, 2)), CAST(425.00 AS Decimal(10, 2)), CAST(0.00 AS Decimal(10, 2)), 1, CAST(N'2021-08-30T18:40:55.857' AS DateTime), CAST(N'2021-08-30T18:40:55.857' AS DateTime), NULL)
INSERT [dbo].[order] ([id], [user_id], [coupon_id], [code], [client], [shipment_date], [shipment_type], [shipment_price], [shipment_status], [shipment_hour], [address], [district], [reference], [total], [subtotal], [discount], [status], [created_at], [updated_at], [deleted_at]) VALUES (3, 3, 1, N'00003', NULL, CAST(N'2021-08-30' AS Date), N'Presencial', CAST(0.00 AS Decimal(10, 2)), 1, NULL, NULL, NULL, NULL, CAST(464.10 AS Decimal(10, 2)), CAST(546.00 AS Decimal(10, 2)), CAST(81.90 AS Decimal(10, 2)), 1, CAST(N'2021-08-30T18:59:12.087' AS DateTime), CAST(N'2021-08-30T18:59:12.090' AS DateTime), NULL)
INSERT [dbo].[order] ([id], [user_id], [coupon_id], [code], [client], [shipment_date], [shipment_type], [shipment_price], [shipment_status], [shipment_hour], [address], [district], [reference], [total], [subtotal], [discount], [status], [created_at], [updated_at], [deleted_at]) VALUES (4, 3, NULL, N'00004', NULL, CAST(N'2021-08-27' AS Date), N'Presencial', CAST(0.00 AS Decimal(10, 2)), 1, NULL, NULL, NULL, NULL, CAST(48.00 AS Decimal(10, 2)), CAST(48.00 AS Decimal(10, 2)), CAST(0.00 AS Decimal(10, 2)), 1, CAST(N'2021-08-27T19:03:29.313' AS DateTime), CAST(N'2021-08-27T19:03:29.317' AS DateTime), NULL)
INSERT [dbo].[order] ([id], [user_id], [coupon_id], [code], [client], [shipment_date], [shipment_type], [shipment_price], [shipment_status], [shipment_hour], [address], [district], [reference], [total], [subtotal], [discount], [status], [created_at], [updated_at], [deleted_at]) VALUES (5, 3, 3, N'00005', NULL, CAST(N'2021-08-30' AS Date), N'Presencial', CAST(0.00 AS Decimal(10, 2)), 1, NULL, NULL, NULL, NULL, CAST(0.00 AS Decimal(10, 2)), CAST(125.00 AS Decimal(10, 2)), CAST(125.00 AS Decimal(10, 2)), 3, CAST(N'2021-08-30T19:06:51.667' AS DateTime), CAST(N'2021-08-30T19:15:18.167' AS DateTime), CAST(N'2021-08-30T19:15:18.167' AS DateTime))
INSERT [dbo].[order] ([id], [user_id], [coupon_id], [code], [client], [shipment_date], [shipment_type], [shipment_price], [shipment_status], [shipment_hour], [address], [district], [reference], [total], [subtotal], [discount], [status], [created_at], [updated_at], [deleted_at]) VALUES (6, 3, 3, N'00006', NULL, CAST(N'2021-08-30' AS Date), N'Presencial', CAST(0.00 AS Decimal(10, 2)), 1, NULL, NULL, NULL, NULL, CAST(100.00 AS Decimal(10, 2)), CAST(125.00 AS Decimal(10, 2)), CAST(25.00 AS Decimal(10, 2)), 1, CAST(N'2021-08-30T19:15:09.020' AS DateTime), CAST(N'2021-08-30T19:15:09.023' AS DateTime), NULL)
INSERT [dbo].[order] ([id], [user_id], [coupon_id], [code], [client], [shipment_date], [shipment_type], [shipment_price], [shipment_status], [shipment_hour], [address], [district], [reference], [total], [subtotal], [discount], [status], [created_at], [updated_at], [deleted_at]) VALUES (7, 2, 3, N'00007', NULL, CAST(N'2021-09-01' AS Date), N'Presencial', CAST(0.00 AS Decimal(10, 2)), 1, NULL, NULL, NULL, NULL, CAST(94.00 AS Decimal(10, 2)), CAST(119.00 AS Decimal(10, 2)), CAST(25.00 AS Decimal(10, 2)), 1, CAST(N'2021-09-01T06:17:50.687' AS DateTime), CAST(N'2021-09-01T06:17:50.707' AS DateTime), NULL)
INSERT [dbo].[order] ([id], [user_id], [coupon_id], [code], [client], [shipment_date], [shipment_type], [shipment_price], [shipment_status], [shipment_hour], [address], [district], [reference], [total], [subtotal], [discount], [status], [created_at], [updated_at], [deleted_at]) VALUES (8, 2, 1, N'00008', NULL, CAST(N'2021-09-01' AS Date), N'Presencial', CAST(0.00 AS Decimal(10, 2)), 1, NULL, NULL, NULL, NULL, CAST(106.25 AS Decimal(10, 2)), CAST(125.00 AS Decimal(10, 2)), CAST(18.75 AS Decimal(10, 2)), 1, CAST(N'2021-09-01T06:19:18.383' AS DateTime), CAST(N'2021-09-01T06:19:18.387' AS DateTime), NULL)
INSERT [dbo].[order] ([id], [user_id], [coupon_id], [code], [client], [shipment_date], [shipment_type], [shipment_price], [shipment_status], [shipment_hour], [address], [district], [reference], [total], [subtotal], [discount], [status], [created_at], [updated_at], [deleted_at]) VALUES (9, 3, NULL, N'00009', NULL, CAST(N'2021-09-01' AS Date), N'Presencial', CAST(0.00 AS Decimal(10, 2)), 1, NULL, NULL, NULL, NULL, CAST(25.00 AS Decimal(10, 2)), CAST(25.00 AS Decimal(10, 2)), CAST(0.00 AS Decimal(10, 2)), 3, CAST(N'2021-09-01T17:24:22.500' AS DateTime), CAST(N'2021-09-01T17:35:24.250' AS DateTime), CAST(N'2021-09-01T17:35:24.250' AS DateTime))
INSERT [dbo].[order] ([id], [user_id], [coupon_id], [code], [client], [shipment_date], [shipment_type], [shipment_price], [shipment_status], [shipment_hour], [address], [district], [reference], [total], [subtotal], [discount], [status], [created_at], [updated_at], [deleted_at]) VALUES (10, 2, 1, N'00010', NULL, CAST(N'2021-09-08' AS Date), N'Presencial', CAST(0.00 AS Decimal(10, 2)), 1, NULL, NULL, NULL, NULL, CAST(488.75 AS Decimal(10, 2)), CAST(575.00 AS Decimal(10, 2)), CAST(86.25 AS Decimal(10, 2)), 1, CAST(N'2021-09-08T05:08:32.870' AS DateTime), CAST(N'2021-09-08T05:08:32.873' AS DateTime), NULL)
INSERT [dbo].[order] ([id], [user_id], [coupon_id], [code], [client], [shipment_date], [shipment_type], [shipment_price], [shipment_status], [shipment_hour], [address], [district], [reference], [total], [subtotal], [discount], [status], [created_at], [updated_at], [deleted_at]) VALUES (11, 2, NULL, N'00011', NULL, CAST(N'2021-09-08' AS Date), N'Presencial', CAST(0.00 AS Decimal(10, 2)), 1, NULL, NULL, NULL, NULL, CAST(48.00 AS Decimal(10, 2)), CAST(48.00 AS Decimal(10, 2)), CAST(0.00 AS Decimal(10, 2)), 1, CAST(N'2021-09-08T05:11:28.987' AS DateTime), CAST(N'2021-09-08T05:11:28.990' AS DateTime), NULL)
INSERT [dbo].[order] ([id], [user_id], [coupon_id], [code], [client], [shipment_date], [shipment_type], [shipment_price], [shipment_status], [shipment_hour], [address], [district], [reference], [total], [subtotal], [discount], [status], [created_at], [updated_at], [deleted_at]) VALUES (12, 2, NULL, N'00012', NULL, CAST(N'2021-09-08' AS Date), N'Presencial', CAST(0.00 AS Decimal(10, 2)), 1, NULL, NULL, NULL, NULL, CAST(25.00 AS Decimal(10, 2)), CAST(25.00 AS Decimal(10, 2)), CAST(0.00 AS Decimal(10, 2)), 1, CAST(N'2021-09-08T05:11:57.837' AS DateTime), CAST(N'2021-09-08T05:11:57.837' AS DateTime), NULL)
INSERT [dbo].[order] ([id], [user_id], [coupon_id], [code], [client], [shipment_date], [shipment_type], [shipment_price], [shipment_status], [shipment_hour], [address], [district], [reference], [total], [subtotal], [discount], [status], [created_at], [updated_at], [deleted_at]) VALUES (13, 7, NULL, N'00013', NULL, CAST(N'2021-09-30' AS Date), N'Delivery', CAST(10.00 AS Decimal(10, 2)), 3, NULL, N'add', N'Barranco', N'ref', CAST(198.00 AS Decimal(10, 2)), CAST(198.00 AS Decimal(10, 2)), CAST(0.00 AS Decimal(10, 2)), 2, CAST(N'2021-09-23T06:12:45.280' AS DateTime), CAST(N'2021-09-23T06:12:45.287' AS DateTime), NULL)
INSERT [dbo].[order] ([id], [user_id], [coupon_id], [code], [client], [shipment_date], [shipment_type], [shipment_price], [shipment_status], [shipment_hour], [address], [district], [reference], [total], [subtotal], [discount], [status], [created_at], [updated_at], [deleted_at]) VALUES (14, 7, NULL, N'00014', NULL, CAST(N'2021-09-30' AS Date), N'Delivery', CAST(10.00 AS Decimal(10, 2)), 3, NULL, N'add', N'Barranco', N'ref', CAST(0.00 AS Decimal(10, 2)), CAST(0.00 AS Decimal(10, 2)), CAST(0.00 AS Decimal(10, 2)), 2, CAST(N'2021-09-23T06:13:41.307' AS DateTime), CAST(N'2021-09-23T06:13:41.307' AS DateTime), NULL)
INSERT [dbo].[order] ([id], [user_id], [coupon_id], [code], [client], [shipment_date], [shipment_type], [shipment_price], [shipment_status], [shipment_hour], [address], [district], [reference], [total], [subtotal], [discount], [status], [created_at], [updated_at], [deleted_at]) VALUES (15, 2, NULL, N'00015', NULL, CAST(N'2021-09-27' AS Date), N'Delivery', CAST(10.00 AS Decimal(10, 2)), 3, NULL, N'address', N'La Victoria', N'reference', CAST(221.00 AS Decimal(10, 2)), CAST(221.00 AS Decimal(10, 2)), CAST(0.00 AS Decimal(10, 2)), 2, CAST(N'2021-09-25T23:30:23.127' AS DateTime), CAST(N'2021-09-25T23:30:23.153' AS DateTime), NULL)
INSERT [dbo].[order] ([id], [user_id], [coupon_id], [code], [client], [shipment_date], [shipment_type], [shipment_price], [shipment_status], [shipment_hour], [address], [district], [reference], [total], [subtotal], [discount], [status], [created_at], [updated_at], [deleted_at]) VALUES (16, 2, NULL, N'00016', NULL, CAST(N'2021-09-27' AS Date), N'Delivery', CAST(10.00 AS Decimal(10, 2)), 3, NULL, N'address', N'Cercado de Lima', N'reference', CAST(198.00 AS Decimal(10, 2)), CAST(198.00 AS Decimal(10, 2)), CAST(0.00 AS Decimal(10, 2)), 2, CAST(N'2021-09-26T15:05:04.353' AS DateTime), CAST(N'2021-09-26T15:05:04.373' AS DateTime), NULL)
INSERT [dbo].[order] ([id], [user_id], [coupon_id], [code], [client], [shipment_date], [shipment_type], [shipment_price], [shipment_status], [shipment_hour], [address], [district], [reference], [total], [subtotal], [discount], [status], [created_at], [updated_at], [deleted_at]) VALUES (17, 2, NULL, N'00017', NULL, CAST(N'2021-09-27' AS Date), N'Delivery', CAST(10.00 AS Decimal(10, 2)), 3, NULL, N'address', N'Cercado de Lima', N'reference', CAST(218.00 AS Decimal(10, 2)), CAST(198.00 AS Decimal(10, 2)), CAST(0.00 AS Decimal(10, 2)), 2, CAST(N'2021-09-26T15:20:28.970' AS DateTime), CAST(N'2021-09-26T15:20:28.980' AS DateTime), NULL)
INSERT [dbo].[order] ([id], [user_id], [coupon_id], [code], [client], [shipment_date], [shipment_type], [shipment_price], [shipment_status], [shipment_hour], [address], [district], [reference], [total], [subtotal], [discount], [status], [created_at], [updated_at], [deleted_at]) VALUES (18, 2, 1, N'00018', NULL, CAST(N'2021-09-27' AS Date), N'Delivery', CAST(10.00 AS Decimal(10, 2)), 3, NULL, N'address', N'Ate', N'reference', CAST(167.05 AS Decimal(10, 2)), CAST(173.00 AS Decimal(10, 2)), CAST(25.95 AS Decimal(10, 2)), 1, CAST(N'2021-09-26T15:52:00.493' AS DateTime), CAST(N'2021-09-26T15:52:00.497' AS DateTime), NULL)
INSERT [dbo].[order] ([id], [user_id], [coupon_id], [code], [client], [shipment_date], [shipment_type], [shipment_price], [shipment_status], [shipment_hour], [address], [district], [reference], [total], [subtotal], [discount], [status], [created_at], [updated_at], [deleted_at]) VALUES (19, 3, NULL, N'00019', NULL, CAST(N'2021-09-26' AS Date), N'Presencial', CAST(0.00 AS Decimal(10, 2)), 1, NULL, NULL, NULL, NULL, CAST(175.00 AS Decimal(10, 2)), CAST(175.00 AS Decimal(10, 2)), CAST(0.00 AS Decimal(10, 2)), 1, CAST(N'2021-09-26T15:58:45.103' AS DateTime), CAST(N'2021-09-26T15:58:45.107' AS DateTime), NULL)
INSERT [dbo].[order] ([id], [user_id], [coupon_id], [code], [client], [shipment_date], [shipment_type], [shipment_price], [shipment_status], [shipment_hour], [address], [district], [reference], [total], [subtotal], [discount], [status], [created_at], [updated_at], [deleted_at]) VALUES (20, 2, NULL, N'00020', NULL, CAST(N'2021-09-28' AS Date), N'Delivery', CAST(10.00 AS Decimal(10, 2)), 3, NULL, N'address', N'Cercado de Lima', N'reference', CAST(208.00 AS Decimal(10, 2)), CAST(198.00 AS Decimal(10, 2)), CAST(0.00 AS Decimal(10, 2)), 2, CAST(N'2021-09-26T16:01:24.370' AS DateTime), CAST(N'2021-09-26T16:01:24.373' AS DateTime), NULL)
INSERT [dbo].[order] ([id], [user_id], [coupon_id], [code], [client], [shipment_date], [shipment_type], [shipment_price], [shipment_status], [shipment_hour], [address], [district], [reference], [total], [subtotal], [discount], [status], [created_at], [updated_at], [deleted_at]) VALUES (21, 2, NULL, N'00021', NULL, CAST(N'2021-10-19' AS Date), N'Delivery', CAST(10.00 AS Decimal(10, 2)), 3, NULL, N'address', N'Carabayllo', N'reference', CAST(193.00 AS Decimal(10, 2)), CAST(173.00 AS Decimal(10, 2)), CAST(0.00 AS Decimal(10, 2)), 1, CAST(N'2021-09-26T16:02:13.683' AS DateTime), CAST(N'2021-09-26T16:02:13.687' AS DateTime), NULL)
INSERT [dbo].[order] ([id], [user_id], [coupon_id], [code], [client], [shipment_date], [shipment_type], [shipment_price], [shipment_status], [shipment_hour], [address], [district], [reference], [total], [subtotal], [discount], [status], [created_at], [updated_at], [deleted_at]) VALUES (22, 2, 3, N'00022', NULL, CAST(N'2021-12-24' AS Date), N'Delivery', CAST(10.00 AS Decimal(10, 2)), 3, NULL, N'add', N'Cercado de Lima', N'reference', CAST(160.00 AS Decimal(10, 2)), CAST(175.00 AS Decimal(10, 2)), CAST(25.00 AS Decimal(10, 2)), 1, CAST(N'2021-09-26T16:06:02.163' AS DateTime), CAST(N'2021-09-26T16:06:02.167' AS DateTime), NULL)
SET IDENTITY_INSERT [dbo].[order] OFF
GO
SET IDENTITY_INSERT [dbo].[category] ON 

INSERT [dbo].[category] ([id], [name], [slug], [created_at], [updated_at], [deleted_at]) VALUES (2, N'Grande', N'grande', CAST(N'2021-08-26T06:10:42.620' AS DateTime), CAST(N'2021-08-26T06:10:42.620' AS DateTime), NULL)
INSERT [dbo].[category] ([id], [name], [slug], [created_at], [updated_at], [deleted_at]) VALUES (3, N'Mediano', N'mediano', CAST(N'2021-08-26T06:10:48.960' AS DateTime), CAST(N'2021-09-30T21:11:23.950' AS DateTime), NULL)
INSERT [dbo].[category] ([id], [name], [slug], [created_at], [updated_at], [deleted_at]) VALUES (4, N'Pequeño', N'pequeno', CAST(N'2021-08-26T06:11:00.087' AS DateTime), CAST(N'2021-09-30T21:11:30.737' AS DateTime), NULL)
INSERT [dbo].[category] ([id], [name], [slug], [created_at], [updated_at], [deleted_at]) VALUES (6, N'Test 2', N'test-2', CAST(N'2021-09-08T05:03:16.807' AS DateTime), CAST(N'2021-09-08T05:03:26.807' AS DateTime), CAST(N'2021-09-08T05:03:26.807' AS DateTime))
SET IDENTITY_INSERT [dbo].[category] OFF
GO
SET IDENTITY_INSERT [dbo].[product] ON 

INSERT [dbo].[product] ([id], [category_id], [code], [name], [slug], [price], [discount], [stock], [description], [created_at], [updated_at], [deleted_at]) VALUES (5, 3, N'00005', N'Producto', N'producto', CAST(25.00 AS Decimal(10, 2)), NULL, 86, N'Descripción', CAST(N'2021-08-28T06:40:21.297' AS DateTime), CAST(N'2021-09-26T16:06:02.180' AS DateTime), NULL)
INSERT [dbo].[product] ([id], [category_id], [code], [name], [slug], [price], [discount], [stock], [description], [created_at], [updated_at], [deleted_at]) VALUES (6, 4, N'00006', N'Producto 1', N'producto-1', CAST(200.00 AS Decimal(10, 2)), CAST(25.00 AS Decimal(10, 2)), 33, N'Descripción', CAST(N'2021-08-28T06:40:40.967' AS DateTime), CAST(N'2021-09-26T16:06:02.177' AS DateTime), NULL)
INSERT [dbo].[product] ([id], [category_id], [code], [name], [slug], [price], [discount], [stock], [description], [created_at], [updated_at], [deleted_at]) VALUES (7, 2, N'00007', N'Producto 2', N'producto-2', CAST(23.00 AS Decimal(10, 2)), NULL, 50, N'Calabaza', CAST(N'2021-08-30T00:19:17.640' AS DateTime), CAST(N'2021-09-26T16:02:13.707' AS DateTime), NULL)
INSERT [dbo].[product] ([id], [category_id], [code], [name], [slug], [price], [discount], [stock], [description], [created_at], [updated_at], [deleted_at]) VALUES (8, 2, N'00008', N'Product delete 2', NULL, CAST(120.00 AS Decimal(10, 2)), CAST(34.00 AS Decimal(10, 2)), 25, N'Description', CAST(N'2021-09-08T05:03:51.193' AS DateTime), CAST(N'2021-09-08T05:04:09.887' AS DateTime), CAST(N'2021-09-08T05:04:09.887' AS DateTime))
SET IDENTITY_INSERT [dbo].[product] OFF
GO
INSERT [dbo].[order_detail] ([product_id], [order_id], [quantity], [price], [price_discount]) VALUES (5, 1, 3, CAST(25.00 AS Decimal(10, 2)), CAST(25.00 AS Decimal(10, 2)))
INSERT [dbo].[order_detail] ([product_id], [order_id], [quantity], [price], [price_discount]) VALUES (6, 1, 1, CAST(200.00 AS Decimal(10, 2)), CAST(150.00 AS Decimal(10, 2)))
INSERT [dbo].[order_detail] ([product_id], [order_id], [quantity], [price], [price_discount]) VALUES (6, 2, 2, CAST(200.00 AS Decimal(10, 2)), CAST(150.00 AS Decimal(10, 2)))
INSERT [dbo].[order_detail] ([product_id], [order_id], [quantity], [price], [price_discount]) VALUES (5, 2, 5, CAST(25.00 AS Decimal(10, 2)), CAST(25.00 AS Decimal(10, 2)))
INSERT [dbo].[order_detail] ([product_id], [order_id], [quantity], [price], [price_discount]) VALUES (5, 3, 2, CAST(25.00 AS Decimal(10, 2)), CAST(25.00 AS Decimal(10, 2)))
INSERT [dbo].[order_detail] ([product_id], [order_id], [quantity], [price], [price_discount]) VALUES (6, 3, 3, CAST(200.00 AS Decimal(10, 2)), CAST(150.00 AS Decimal(10, 2)))
INSERT [dbo].[order_detail] ([product_id], [order_id], [quantity], [price], [price_discount]) VALUES (7, 3, 2, CAST(23.00 AS Decimal(10, 2)), CAST(23.00 AS Decimal(10, 2)))
INSERT [dbo].[order_detail] ([product_id], [order_id], [quantity], [price], [price_discount]) VALUES (5, 7, 2, CAST(25.00 AS Decimal(10, 2)), CAST(25.00 AS Decimal(10, 2)))
INSERT [dbo].[order_detail] ([product_id], [order_id], [quantity], [price], [price_discount]) VALUES (7, 7, 3, CAST(23.00 AS Decimal(10, 2)), CAST(23.00 AS Decimal(10, 2)))
INSERT [dbo].[order_detail] ([product_id], [order_id], [quantity], [price], [price_discount]) VALUES (5, 8, 5, CAST(25.00 AS Decimal(10, 2)), CAST(25.00 AS Decimal(10, 2)))
INSERT [dbo].[order_detail] ([product_id], [order_id], [quantity], [price], [price_discount]) VALUES (5, 9, 1, CAST(25.00 AS Decimal(10, 2)), CAST(25.00 AS Decimal(10, 2)))
INSERT [dbo].[order_detail] ([product_id], [order_id], [quantity], [price], [price_discount]) VALUES (6, 10, 3, CAST(200.00 AS Decimal(10, 2)), CAST(150.00 AS Decimal(10, 2)))
INSERT [dbo].[order_detail] ([product_id], [order_id], [quantity], [price], [price_discount]) VALUES (5, 10, 5, CAST(25.00 AS Decimal(10, 2)), CAST(25.00 AS Decimal(10, 2)))
INSERT [dbo].[order_detail] ([product_id], [order_id], [quantity], [price], [price_discount]) VALUES (5, 11, 1, CAST(25.00 AS Decimal(10, 2)), CAST(25.00 AS Decimal(10, 2)))
INSERT [dbo].[order_detail] ([product_id], [order_id], [quantity], [price], [price_discount]) VALUES (7, 11, 1, CAST(23.00 AS Decimal(10, 2)), CAST(23.00 AS Decimal(10, 2)))
INSERT [dbo].[order_detail] ([product_id], [order_id], [quantity], [price], [price_discount]) VALUES (5, 12, 1, CAST(25.00 AS Decimal(10, 2)), CAST(25.00 AS Decimal(10, 2)))
INSERT [dbo].[order_detail] ([product_id], [order_id], [quantity], [price], [price_discount]) VALUES (5, 13, 1, CAST(25.00 AS Decimal(10, 2)), CAST(25.00 AS Decimal(10, 2)))
INSERT [dbo].[order_detail] ([product_id], [order_id], [quantity], [price], [price_discount]) VALUES (6, 13, 1, CAST(150.00 AS Decimal(10, 2)), CAST(150.00 AS Decimal(10, 2)))
INSERT [dbo].[order_detail] ([product_id], [order_id], [quantity], [price], [price_discount]) VALUES (7, 13, 1, CAST(23.00 AS Decimal(10, 2)), CAST(23.00 AS Decimal(10, 2)))
INSERT [dbo].[order_detail] ([product_id], [order_id], [quantity], [price], [price_discount]) VALUES (5, 15, 1, CAST(25.00 AS Decimal(10, 2)), CAST(25.00 AS Decimal(10, 2)))
INSERT [dbo].[order_detail] ([product_id], [order_id], [quantity], [price], [price_discount]) VALUES (6, 15, 1, CAST(150.00 AS Decimal(10, 2)), CAST(150.00 AS Decimal(10, 2)))
INSERT [dbo].[order_detail] ([product_id], [order_id], [quantity], [price], [price_discount]) VALUES (7, 15, 2, CAST(23.00 AS Decimal(10, 2)), CAST(23.00 AS Decimal(10, 2)))
INSERT [dbo].[order_detail] ([product_id], [order_id], [quantity], [price], [price_discount]) VALUES (5, 16, 1, CAST(25.00 AS Decimal(10, 2)), CAST(25.00 AS Decimal(10, 2)))
INSERT [dbo].[order_detail] ([product_id], [order_id], [quantity], [price], [price_discount]) VALUES (6, 16, 1, CAST(150.00 AS Decimal(10, 2)), CAST(150.00 AS Decimal(10, 2)))
INSERT [dbo].[order_detail] ([product_id], [order_id], [quantity], [price], [price_discount]) VALUES (7, 16, 1, CAST(23.00 AS Decimal(10, 2)), CAST(23.00 AS Decimal(10, 2)))
INSERT [dbo].[order_detail] ([product_id], [order_id], [quantity], [price], [price_discount]) VALUES (5, 17, 1, NULL, CAST(25.00 AS Decimal(10, 2)))
INSERT [dbo].[order_detail] ([product_id], [order_id], [quantity], [price], [price_discount]) VALUES (6, 17, 1, NULL, CAST(150.00 AS Decimal(10, 2)))
INSERT [dbo].[order_detail] ([product_id], [order_id], [quantity], [price], [price_discount]) VALUES (5, 19, 1, CAST(25.00 AS Decimal(10, 2)), CAST(25.00 AS Decimal(10, 2)))
INSERT [dbo].[order_detail] ([product_id], [order_id], [quantity], [price], [price_discount]) VALUES (6, 19, 1, CAST(150.00 AS Decimal(10, 2)), CAST(200.00 AS Decimal(10, 2)))
INSERT [dbo].[order_detail] ([product_id], [order_id], [quantity], [price], [price_discount]) VALUES (5, 20, 1, CAST(25.00 AS Decimal(10, 2)), CAST(25.00 AS Decimal(10, 2)))
INSERT [dbo].[order_detail] ([product_id], [order_id], [quantity], [price], [price_discount]) VALUES (7, 20, 1, CAST(23.00 AS Decimal(10, 2)), CAST(23.00 AS Decimal(10, 2)))
INSERT [dbo].[order_detail] ([product_id], [order_id], [quantity], [price], [price_discount]) VALUES (6, 20, 1, CAST(150.00 AS Decimal(10, 2)), CAST(150.00 AS Decimal(10, 2)))
INSERT [dbo].[order_detail] ([product_id], [order_id], [quantity], [price], [price_discount]) VALUES (6, 21, 1, CAST(150.00 AS Decimal(10, 2)), CAST(150.00 AS Decimal(10, 2)))
INSERT [dbo].[order_detail] ([product_id], [order_id], [quantity], [price], [price_discount]) VALUES (7, 21, 1, CAST(23.00 AS Decimal(10, 2)), CAST(23.00 AS Decimal(10, 2)))
INSERT [dbo].[order_detail] ([product_id], [order_id], [quantity], [price], [price_discount]) VALUES (6, 22, 1, CAST(150.00 AS Decimal(10, 2)), CAST(150.00 AS Decimal(10, 2)))
INSERT [dbo].[order_detail] ([product_id], [order_id], [quantity], [price], [price_discount]) VALUES (5, 22, 1, CAST(25.00 AS Decimal(10, 2)), CAST(25.00 AS Decimal(10, 2)))
INSERT [dbo].[order_detail] ([product_id], [order_id], [quantity], [price], [price_discount]) VALUES (5, 4, 1, CAST(25.00 AS Decimal(10, 2)), CAST(25.00 AS Decimal(10, 2)))
INSERT [dbo].[order_detail] ([product_id], [order_id], [quantity], [price], [price_discount]) VALUES (7, 4, 1, CAST(23.00 AS Decimal(10, 2)), CAST(23.00 AS Decimal(10, 2)))
INSERT [dbo].[order_detail] ([product_id], [order_id], [quantity], [price], [price_discount]) VALUES (5, 5, 5, CAST(25.00 AS Decimal(10, 2)), CAST(25.00 AS Decimal(10, 2)))
INSERT [dbo].[order_detail] ([product_id], [order_id], [quantity], [price], [price_discount]) VALUES (5, 6, 5, CAST(25.00 AS Decimal(10, 2)), CAST(25.00 AS Decimal(10, 2)))
INSERT [dbo].[order_detail] ([product_id], [order_id], [quantity], [price], [price_discount]) VALUES (7, 17, 1, NULL, CAST(23.00 AS Decimal(10, 2)))
INSERT [dbo].[order_detail] ([product_id], [order_id], [quantity], [price], [price_discount]) VALUES (6, 18, 1, NULL, CAST(150.00 AS Decimal(10, 2)))
INSERT [dbo].[order_detail] ([product_id], [order_id], [quantity], [price], [price_discount]) VALUES (7, 18, 1, NULL, CAST(23.00 AS Decimal(10, 2)))
GO
SET IDENTITY_INSERT [dbo].[product_photo] ON 

INSERT [dbo].[product_photo] ([id], [product_id], [image], [order], [created_at], [updated_at], [deleted_at]) VALUES (2, 5, N'http://localhost:8000/img/product/1630167207-imagen_2021-08-28_111326.png', 1, CAST(N'2021-08-28T16:13:27.863' AS DateTime), CAST(N'2021-08-28T16:13:27.863' AS DateTime), NULL)
INSERT [dbo].[product_photo] ([id], [product_id], [image], [order], [created_at], [updated_at], [deleted_at]) VALUES (4, 5, N'http://localhost:8000/img/product/1630274073-image-2.png', 6, CAST(N'2021-08-29T21:54:33.600' AS DateTime), CAST(N'2021-09-15T06:25:11.257' AS DateTime), NULL)
INSERT [dbo].[product_photo] ([id], [product_id], [image], [order], [created_at], [updated_at], [deleted_at]) VALUES (1004, 5, N'http://localhost:8000/img/product/1631687080-imagen_2021-09-15_012439.png', 2, CAST(N'2021-09-15T06:24:40.870' AS DateTime), CAST(N'2021-09-15T06:24:40.870' AS DateTime), NULL)
INSERT [dbo].[product_photo] ([id], [product_id], [image], [order], [created_at], [updated_at], [deleted_at]) VALUES (1005, 5, N'http://localhost:8000/img/product/1631687089-imagen_2021-09-15_012447.png', 4, CAST(N'2021-09-15T06:24:49.117' AS DateTime), CAST(N'2021-09-15T06:24:49.117' AS DateTime), NULL)
INSERT [dbo].[product_photo] ([id], [product_id], [image], [order], [created_at], [updated_at], [deleted_at]) VALUES (1006, 5, N'http://localhost:8000/img/product/1631687096-imagen_2021-09-15_012455.png', 5, CAST(N'2021-09-15T06:24:56.610' AS DateTime), CAST(N'2021-09-15T06:24:56.610' AS DateTime), NULL)
INSERT [dbo].[product_photo] ([id], [product_id], [image], [order], [created_at], [updated_at], [deleted_at]) VALUES (1007, 5, N'http://localhost:8000/img/product/1631687681-imagen_2021-09-15_013440.png', 7, CAST(N'2021-09-15T06:34:41.890' AS DateTime), CAST(N'2021-09-15T06:34:41.890' AS DateTime), NULL)
SET IDENTITY_INSERT [dbo].[product_photo] OFF
GO
SET IDENTITY_INSERT [dbo].[migrations] ON 

INSERT [dbo].[migrations] ([id], [migration], [batch]) VALUES (1, N'2021_08_28_165902_create_permission_tables', 1)
SET IDENTITY_INSERT [dbo].[migrations] OFF
GO
SET IDENTITY_INSERT [dbo].[settings] ON 

INSERT [dbo].[settings] ([id], [name], [email], [address], [logo], [phone], [facebook], [instagram], [twitter], [created_at], [updated_at]) VALUES (1, N'Portal Commerce', N'email@email.com', N'address', N'http://localhost:8000/img/settings/1631486321-imagen_2021-09-12_173840.png', N'123456780', NULL, NULL, NULL, NULL, CAST(N'2021-09-12T22:38:41.607' AS DateTime))
SET IDENTITY_INSERT [dbo].[settings] OFF
GO
