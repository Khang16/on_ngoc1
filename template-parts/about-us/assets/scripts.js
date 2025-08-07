import { targetHome } from "../../front-page/section-chinh-phuc/assets/scripts.js";
import { teacherAbout} from "../section-giang-vien/assets/script.js";
import { initializeTeacherPopup } from "../section-giang-vien/assets/script.js"
import { circularText } from "../section-doi-ngu/assets/scripts.js";
teacherAbout();
targetHome();
circularText();
document.addEventListener("DOMContentLoaded", function () {
    initializeTeacherPopup();
});
