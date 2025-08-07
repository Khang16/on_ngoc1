<?php
$opening_course_schedule_acf = get_field("opening_course_schedule_v3");
?>

<div></div>
<section class="opening-course-schedule">
	<?php echo wp_get_attachment_image(485, 'full', false, array('class' => 'page-background-decor')) ?>
	<?php echo wp_get_attachment_image(485, 'full', false, array('class' => 'page-background-decor')) ?>
	<?php echo wp_get_attachment_image(485, 'full', false, array('class' => 'page-background-decor')) ?>
	<div class="opening-course-schedule-wrapper">
		<?php if (!empty($opening_course_schedule_acf)): ?>
			<div class="opening-course-schedule__list">
				<?php foreach ($opening_course_schedule_acf as $opening_course_schedule_item): ?>
					<?php
					$course_online = $opening_course_schedule_item["online_course"];
					$course_offline = $opening_course_schedule_item["offline_course"];
					?>
					<div class="opening-course-schedule__item">
						<div class="opening-course-schedule__item-inner">
							<div class="opening-course-schedule__item-top">
								<h3 class="opening-course-schedule__item-name">
									<span class="course-title course-title--online">
										<?= $course_online["course_title"] ?? ""; ?>
									</span>
									<span class="course-title course-title--offline active">
										<?= $course_offline["course_title"] ?? ""; ?>
									</span>
								</h3>
								<div class="tab-wrapper">
									<button class="tab-item tab-item--online">
										<span class="tab-item__text">Online</span>
									</button>
									<button class="tab-item tab-item--offline active">
										<span class="tab-item__text">Offline</span>
									</button>
									<div class="tab-active-bg"></div>
								</div>
							</div>
							<!-- Start Course Online -->
							<div class="course-table-wrapper course-table-wrapper--online">
								<table class="opening-course-schedule__item-table course-table course-table--online">
									<thead class="course-table__head">
										<tr>
											<th>
												<p class="course-table__head-label">Chương trình</p>
											</th>
											<!-- <th><p class="course-table__head-label">Mã lớp</p></th> -->
											<th>
												<p class="course-table__head-label">Lịch học</p>
											</th>
											<th>
												<p class="course-table__head-label">Giờ học</p>
											</th>
											<!-- <th><p class="course-table__head-label">Khai giảng dự kiến</p></th> -->
											<!-- <th><p class="course-table__head-label">Số lượng học viên</p></th> -->
											<th></th>
										</tr>
									</thead>
									<?php if (!empty($course_online['course_list'])): ?>
										<tbody class="course-table__body">
											<?php
											$count = 0;
											foreach ($course_online['course_list'] as $course_item):
												$course_name = $course_item["course_name"];
												$class_list = $course_item["course_class_list"] ?? [];
												foreach ($class_list as $index => $item):
											?>
													<tr data-count="<?= $count; ?>" data-first-row="true">
														<?php if ($index === 0): ?>
															<td rowspan="<?= count($class_list) ?>">
																<div><?= $course_name ?></div>
															</td>
														<?php endif; ?>
														<!-- <td class="class_id">
															<div><?= $item['class_code'] ?? '' ?></div>
														</td> -->
														<td class="class_schedule">
															<div><?= $item['study_schedule'] ?? '' ?></div>
														</td>
														<td class="class_time">
															<div><?= $item['study_time'] ?? '' ?></div>
														</td>
														<!-- <td class="class_opening_date">
															<div><?= $item['opening_schedule'] ?? '' ?></div>
														</td>
														<td class="class_quantity_member">
															<div><?= $item['number_students'] ?? '' ?></div>
														</td> -->
														<td>
															<div>
																<?php
																if (!wp_is_mobile()):
																	$link = $item["link_register"];
																	if (!empty($link)):
																		$link_url = $link["url"] ?? "#";
																		$link_target = $link["target"] ? $link["target"] : "_self";
																?>
																		<a target="<?= $link_target; ?>" href="<?= $link_url; ?>" class="course_register_link">
																			<span class="course_register_link-text">
																				Liên hệ
																			</span>
																		</a>
																	<?php
																	endif;
																else:
																	?>

																	<button
																		data-id="<?= $item['class_code']; ?>"
																		data-name="<?= $course_name; ?>"
																		data-study-time="<?= $item['study_time']; ?>"
																		data-quantity-member="<?= $item['number_students']; ?>"
																		data-study-schedule="<?= $item['study_schedule']; ?>"
																		data-opening-schedule="<?= $item['opening_schedule']; ?>"
																		data-link-register="<?= $item["link_register"]["url"] ?? "#"; ?>"
																		class="detail-course-btn">
																		Chi tiết
																	</button>
																<?php
																endif;
																?>
															</div>
														</td>
													</tr>
											<?php
													$count = $count + 1;
												endforeach;
											endforeach;
											?>
										</tbody>
									<?php else: ?>
										<tbody class="course-table__body">
											<tr>
												<td class="empty-course-col" colspan="7">
													<div>Không tìm thấy khoá học nào</div>
												</td>
											</tr>
										</tbody>
									<?php endif; ?>
								</table>
							</div>
							<!-- End: Course Online -->

							<!-- Start Course Online -->
							<div class="course-table-wrapper course-table-wrapper--offline active">
								<table class="opening-course-schedule__item-table course-table course-table--offline">
									<thead class="course-table__head">
										<tr>
											<th>
												<p class="course-table__head-label">Chương trình</p>
											</th>
											<!-- <th>
												<p class="course-table__head-label">Mã lớp</p>
											</th> -->
											<th>
												<p class="course-table__head-label">Lịch học</p>
											</th>
											<th>
												<p class="course-table__head-label">Giờ học</p>
											</th>
											<!-- <th>
												<p class="course-table__head-label">Khai giảng dự kiến</p>
											</th>
											<th>
												<p class="course-table__head-label">Số lượng học viên</p>
											</th> -->
											<th></th>
										</tr>
									</thead>
									<?php if (!empty($course_offline['course_list'])): ?>
										<tbody class="course-table__body">
											<?php
											$count = 0;
											foreach ($course_offline['course_list'] as $course_item):
												$course_name = $course_item["course_name"];
												$class_list = $course_item["course_class_list"] ?? [];
												foreach ($class_list as $index => $item):
											?>
													<tr data-count="<?= $count; ?>" data-first-row="true">
														<?php if ($index === 0): ?>
															<td rowspan="<?= count($class_list) ?>">
																<div><?= $course_name ?></div>
															</td>
														<?php endif; ?>
														<!-- <td class="class_id">
															<div><?= $item['class_code'] ?? '' ?></div>
														</td> -->
														<td class="class_schedule">
															<div><?= $item['study_schedule'] ?? '' ?></div>
														</td>
														<td class="class_time">
															<div><?= $item['study_time'] ?? '' ?></div>
														</td>
														<!-- <td class="class_opening_date">
															<div><?= $item['opening_schedule'] ?? '' ?></div>
														</td>
														<td class="class_quantity_member">
															<div><?= $item['number_students'] ?? '' ?></div>
														</td> -->
														<td>
															<div>
																<?php
																if (!wp_is_mobile()):
																	$link = $item["link_register"];
																	if (!empty($link)):
																		$link_url = $link["url"] ?? "#";
																		$link_target = $link["target"] ? $link["target"] : "_self";
																?>
																		<a target="<?= $link_target; ?>" href="<?= $link_url; ?>" class="course_register_link">
																			<span class="course_register_link-text">
																				Liên hệ
																			</span>
																		</a>
																	<?php
																	endif;
																else:
																	?>

																	<button
																		data-id="<?= $item['class_code']; ?>"
																		data-name="<?= $course_name; ?>"
																		data-study-time="<?= $item['study_time']; ?>"
																		data-quantity-member="<?= $item['number_students']; ?>"
																		data-study-schedule="<?= $item['study_schedule']; ?>"
																		data-opening-schedule="<?= $item['opening_schedule']; ?>"
																		data-link-register="<?= $item["link_register"]["url"] ?? "#"; ?>"
																		class="detail-course-btn">
																		Chi tiết
																	</button>
																<?php
																endif;
																?>
															</div>
														</td>
													</tr>
											<?php
													$count = $count + 1;
												endforeach;
											endforeach;
											?>
										</tbody>
									<?php else: ?>
										<tbody class="course-table__body">
											<tr>
												<td class="empty-course-col" colspan="7">
													<div>Không tìm thấy khoá học nào</div>
												</td>
											</tr>
										</tbody>
									<?php endif; ?>
								</table>
							</div>
							<!-- End: Course Online -->
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</section>