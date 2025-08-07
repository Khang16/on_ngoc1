<?php 
$discount = get_field("discount", "option");
$type = $discount["type_popup"];
$status = $discount["discount_status"];
?>
<?php if($status === "active"): ?>
<div class="popup-discount">
	<div class="popup-discount__overlay"></div>
	<div class="popup-discount__content <?= $type ?>">
        <button class="popup-close-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 35 35" fill="none">
            <path d="M9.33464 27.7087L7.29297 25.667L15.4596 17.5003L7.29297 9.33366L9.33464 7.29199L17.5013 15.4587L25.668 7.29199L27.7096 9.33366L19.543 17.5003L27.7096 25.667L25.668 27.7087L17.5013 19.542L9.33464 27.7087Z" fill="#6B6A6E"/>
            </svg>
        </button>
        <?php echo wp_get_attachment_image($discount["discount_image"], 'full', false, array( 'class' => 'discount-image')) ?>
	</div>
</div>
<?php endif; ?>