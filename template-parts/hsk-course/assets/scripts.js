import StudyScheduleInit from '../section-study-schedule/assets/scripts.js'
import specialFeature from '../section-special-feature/assets/scripts.js'
import section1000StudentsInit from '../section-1000-students/assets/scripts.js'
import sectionAppreciateInit from '../section-appreciate/assets/scripts.js'
import faqs from "../../components/faqs/assets/scripts.js";
import { footerForm } from "../../page-course/footer-form/assets/scripts.js";


document.addEventListener('DOMContentLoaded', () => {
	StudyScheduleInit()
	specialFeature()
	section1000StudentsInit()
	sectionAppreciateInit()
	faqs();
	footerForm();
})
