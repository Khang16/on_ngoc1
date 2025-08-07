export function circularText() {
	const circularEl = document.getElementById("circular-text");
// 	const text = circularEl.dataset.text || "HELLO";
	const duration = parseFloat(circularEl.dataset.spinDuration) || 20;
	const onHover = circularEl.dataset.hover || "speedUp";

	const angleStep = 360 / text.length;
	let radius = 65;
	const letters = [...text];

	if (window.innerWidth >= 640) {
		radius = 64;
	} else {
		radius = 34;
	}



	// Xoay toàn bộ container
	circularEl.style.animationDuration = `${duration}s`;
	letters.forEach((letter, i) => {
		const span = document.createElement("span");
		const angle = angleStep * i;
		const rad = (angle * Math.PI) / 180;
		const x = radius * Math.cos(rad);
		const y = radius * Math.sin(rad);

		const xRem = x / 16;
		const yRem = y / 16;

		span.textContent = letter;

		// Di chuyển chữ đến vị trí và xoay ngược lại để giữ thẳng đứng (dùng rem)
		span.style.transform = `
translate(${xRem}rem, ${yRem}rem)
rotate(${angle + 90}deg)
`;

		circularEl.appendChild(span);
	});
}