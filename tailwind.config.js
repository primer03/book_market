/** @type {import('tailwindcss').Config} */
module.exports = {
    content: ["./admin/assets/**/*.{html,js,php}", "./admin/**/*.{html,js,php}", "./src/**/*.{html,js,php}", "./index.html", "./index.php", "./auth/**/*.{html,js,php}", "./auth/register.php", "./src/page/**/*.{html,js,php}", "./src/page/home.php", "./src/page/book.php", "./src/page/area.php"],
    theme: {
        extend: {
            keyframes: {
                zoom: {
                    "0%": {
                        transform: "scale(0)",
                    },
                    "100%": {
                        transform: "scale(1)",
                    },
                },
                bounceIn: {
                    "0%": {
                        transform: "scale(0)",
                    },
                    "50%": {
                        transform: "scale(1.2)",
                    },
                    "100%": {
                        transform: "scale(1)",
                    },
                },
                zoomInDown: {
                    "0%": {
                        opacity: "0",
                        transform: "scale(0.1) translate3d(0, -1000px, 0)",
                        animationTimingFunction: "cubic-bezier(0.550, 0.055, 0.675, 0.190)",
                    },
                    "60%": {
                        opacity: "1",
                        transform: "scale(0.475) translate3d(0, 60px, 0)",
                        animationTimingFunction: "cubic-bezier(0.175, 0.885, 0.320, 1)",
                    },
                    "100%": {
                        opacity: "1",
                        transform: "scale(1) translate3d(0, 0, 0)",
                        animationTimingFunction: "cubic-bezier(0.175, 0.885, 0.320, 1)",
                    },
                },
                heartBeat: {
                    "0%": {
                        transform: "scale(1)",
                        animationTimingFunction: "ease-in-out",
                    },
                    "14%": {
                        transform: "scale(1.02)",
                        animationTimingFunction: "ease-in-out",
                    },
                    "28%": {
                        transform: "scale(1)",
                        animationTimingFunction: "ease-in-out",
                    },
                    "42%": {
                        transform: "scale(1.02)",
                        animationTimingFunction: "ease-in-out",
                    },
                    "70%": {
                        transform: "scale(1)",
                        animationTimingFunction: "ease-in-out",
                    },
                },
                fadeIn: {
                    "0%": {
                        opacity: "0",
                    },
                    "100%": {
                        opacity: "1",
                    },
                },
                progressBarAnimation: {
                    "0%": {
                        width: "0%",
                    },
                    "100%": {
                        width: "100%",
                    },
                },
                zoomOutDown: {
                    "0%": {
                        opacity: "1",
                        transform: "scale(1) translate3d(0, 0, 0)",
                        animationTimingFunction: "cubic-bezier(0.550, 0.055, 0.675, 0.190)",
                    },
                    "60%": {
                        opacity: "1",
                        transform: "scale(0.475) translate3d(0, 60px, 0)",
                        animationTimingFunction: "cubic-bezier(0.175, 0.885, 0.320, 1)",
                    },
                    "100%": {
                        opacity: "0",
                        transform: "scale(0.1) translate3d(0, -1000px, 0)",
                        animationTimingFunction: "cubic-bezier(0.175, 0.885, 0.320, 1)",
                    },
                },
            },
            animation: {
                'zoom-animation': "zoom 0.5s ease-in-out",
                'bounceIn': "bounceIn 0.5s ease-in-out",
                'zoomInDown': "zoomInDown 0.5s ease-in-out",
                'heartBeat': "heartBeat 1s ease-in-out",
                'fadeIn': "fadeIn 1s ease-in-out",
                'shakeX': "shakeX 1s ease-in-out",
                'progressBarAnimation': "progressBarAnimation 4s ease-in-out",
                'zoomOutDown': "zoomOutDown 0.5s ease-in-out",
            },
        },
    },
    plugins: [require("daisyui")],
}