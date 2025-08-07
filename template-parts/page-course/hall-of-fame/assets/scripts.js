export const achievementBoard = () => {
    // Register GSAP plugins
    gsap.registerPlugin(MotionPathPlugin);

    // Query avatar là SVG <image> bên trong SVG
    const avatars = document.querySelectorAll(
        ".achievement-board__svg .achievement-board__avatar"
    );

    // Map bán kính cho từng orbit
    const orbitRadius = {
        orbit2: 611,
        orbit3: 511,
        orbit4: 409,
        orbit5: 701,
    };
    const baseSpeed = 100; // px/giây, có thể điều chỉnh

    // Gom avatar theo orbit
    const avatarsByOrbit = {};
    avatars.forEach((avatar) => {
        const orbitId = avatar.getAttribute("data-orbit");
        if (!avatarsByOrbit[orbitId]) avatarsByOrbit[orbitId] = [];
        avatarsByOrbit[orbitId].push(avatar);
    });

    Object.entries(avatarsByOrbit).forEach(([orbitId, orbitAvatars]) => {
        const radius = orbitRadius[orbitId];
        const circumference = 2 * Math.PI * radius;
        const duration = circumference / baseSpeed; // duration giống nhau cho mọi avatar trên orbit này
        const orbitNumber = parseInt(orbitId.replace("orbit", ""), 10);
        const orbitPathId = `${orbitId}-path`;

        orbitAvatars.forEach((avatar) => {
            const startProgress = parseFloat(avatar.getAttribute("data-start"));
            let motionPathConfig;
            if (orbitNumber % 2 === 0) {
                // orbit chẵn: chạy ngược chiều
                motionPathConfig = {
                    path: `#${orbitPathId}`,
                    autoRotate: false,
                    start: startProgress + 1,
                    end: startProgress,
                    align: `#${orbitPathId}`,
                    alignOrigin: [0.5, 0.5],
                };
            } else {
                // orbit lẻ: chạy thuận chiều
                motionPathConfig = {
                    path: `#${orbitPathId}`,
                    autoRotate: false,
                    start: startProgress,
                    end: startProgress + 1,
                    align: `#${orbitPathId}`,
                    alignOrigin: [0.5, 0.5],
                };
            }

            gsap.set(avatar, {
                motionPath: {
                    path: `#${orbitPathId}`,
                    autoRotate: false,
                },
            });

            gsap.to(avatar, {
                duration: duration,
                ease: "none",
                repeat: -1,
                force3D: true,
                motionPath: motionPathConfig,
            });
        });
    });

    // Add subtle floating animation to the content
    gsap.to(".achievement-board__content", {
        y: -10,
        duration: 2.5,
        ease: "power2.inOut",
        yoyo: true,
        repeat: 1,
    });

    // Add entrance animations
    gsap.from(".achievement-board__title", {
        opacity: 0,
        y: 50,
        duration: 1.2,
        ease: "power3.out",
        delay: 0.5,
    });

    gsap.from(".achievement-board__desc", {
        opacity: 0,
        y: 30,
        duration: 1,
        ease: "power3.out",
        delay: 0.8,
    });

    gsap.fromTo(
        ".achievement-board__avatar",
        { opacity: 0, scale: 0.7 },
        {
            opacity: 1,
            scale: 1,
            transformOrigin: "50% 50%",
            duration: 1,
            ease: "back.out(1.7)",
            stagger: 0.15,
            delay: 1.2,
        }
    );

    // Add subtle pulsing animation to white dots
    gsap.to('circle[fill="white"]', {
        opacity: 0.3,
        duration: 2,
        ease: "power2.inOut",
        yoyo: true,
        repeat: -1,
        stagger: 0.3,
    });
};
