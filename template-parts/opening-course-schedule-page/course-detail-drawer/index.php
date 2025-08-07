<?php if(wp_is_mobile()): ?>
<div class="course-detail-drawer">
	<div class="course-detail-drawer__overlay"></div>
	<div class="course-detail-drawer__content">
		<h4 class="course-detail-drawer__content-class__name">
		</h4>
		<p class="course-detail-drawer__content-class__id">
			Mã lớp: <span></span>
		</p>
		<div class="course-detail-drawer__content-class__info-detail">
			<div>
				<div class="course-detail-drawer__content-class__opening-schedule">
					<?php echo wp_get_attachment_image(490, 'full', false, array( 'class' => 'course-detail-drawer__content-class__opening-schedule-icon')) ?>
					<div class="course-detail-drawer__content-class__opening-schedule-content">
						<p>Khai giảng dự kiến</p>
						<span></span>
					</div>
				</div>
				<div class="course-detail-drawer__content-class__quantity-member">
					<?php echo wp_get_attachment_image(489, 'full', false, array( 'class' => 'course-detail-drawer__content-class__quantity-member-icon')) ?>
					<div class="course-detail-drawer__content-class__quantity-member-content">
						<p>Số lượng học viên</p>
						<span></span>
					</div>
				</div>
			</div>
			<div class="course-detail-drawer__content-class__time">
				<?php echo wp_get_attachment_image(487, 'full', false, array( 'class' => 'course-detail-drawer__content-class__time-icon')) ?>
				<div class="course-detail-drawer__content-class__time-content">
					<p>Giờ học</p>
					<span></span>
				</div>
			</div>
			<div class="course-detail-drawer__content-class__schedule">
				<?php echo wp_get_attachment_image(486, 'full', false, array( 'class' => 'course-detail-drawer__content-class__schedule-icon')) ?>
				<div class="course-detail-drawer__content-class__schedule-content">
					<p>Lịch học</p>
					<span></span>
				</div>
			</div>
		</div>
		<a href="#" class="course-detail-drawer__content-class__register-now">
			Đăng ký ngay
		</a>
	</div>
</div>
<?php endif; ?>