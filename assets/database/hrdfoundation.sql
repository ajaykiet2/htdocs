-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2018 at 03:24 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hrdfoundation`
--

-- --------------------------------------------------------

--
-- Table structure for table `accreditation`
--

CREATE TABLE `accreditation` (
  `id` int(11) NOT NULL,
  `title` varchar(20) NOT NULL,
  `name` text NOT NULL,
  `tagline` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` text NOT NULL,
  `timeStamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accreditation`
--

INSERT INTO `accreditation` (`id`, `title`, `name`, `tagline`, `description`, `image`, `timeStamp`) VALUES
(1, 'IRDAI', 'Insurance Regulatory and Development Authority of India', 'Training Institute', 'The Insurance Regulatory and Development Authority of India (IRDAI) is an autonomous, statutary agency tasked with regulating and promoting the insurance and re-insurance industries in India. It was constituted by the Insurance Regulatory and Development Authority Act, 1999, an act of Parliament passed by the government of India. The agency''s headquarters are in Hyderabad, Telangana, where it moved from Delhi in 2001.\r\n\r\nIRDAI is a 10-member body including the chairman, five full-time and four part-time members appointed by the government of India.', 'irdai.jpg', '2017-05-18 00:02:35'),
(2, 'NIELIT', 'National Institute of Electronics & Information Technology', 'Accredited Institute', 'National Institute of Electronics & Information Technology (NIELIT),(erstwhile DOEACC Society), an Autonomous Scientific Society under the administrative control of Ministry of Electronics & Information Technology (MoE&IT), Government of India, was set up to carry out Human Resource Development and related activities in the area of Information, Electronics & Communications Technology (IECT). NIELIT is engaged both in Formal & Non-Formal Education in the area of IECT besides development of industry oriented quality education and training programmes in the state-of-the-art areas. NIELIT has endeavoured to establish standards to be the country’s premier institution for Examination and Certification in the field of IECT. It is also one of the National Examination Body, which accredits institutes/organizations for conducting courses in IT in the non-formal sector.', 'nielit.jpg', '2017-05-18 00:02:35'),
(3, 'IIOI', 'Insurance Institute Of India', 'Learning Center', 'The Insurance Institute of India is an insurance education society of professionals established in 1955 in Mumbai for the purpose of imparting insurance education to persons engaged or interested in insurance. It is the professional institute in India devoted solely to insurance-related education.', 'iioi.jpg', '2017-05-18 00:04:57');

-- --------------------------------------------------------

--
-- Table structure for table `assessment`
--

CREATE TABLE `assessment` (
  `assessmentID` int(11) NOT NULL,
  `companyID` int(11) NOT NULL,
  `courseID` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `totalQuestions` int(3) NOT NULL,
  `duration` int(3) NOT NULL,
  `passingMarks` int(3) NOT NULL,
  `questionSets` int(3) NOT NULL,
  `timeStamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assessment`
--

INSERT INTO `assessment` (`assessmentID`, `companyID`, `courseID`, `code`, `title`, `description`, `totalQuestions`, `duration`, `passingMarks`, `questionSets`, `timeStamp`) VALUES
(4, 1, 2, 1, 'Test Exam', 'Test Exam Description', 50, 60, 18, 2, '2017-06-03 20:37:59');

-- --------------------------------------------------------

--
-- Table structure for table `assessmentattempt`
--

CREATE TABLE `assessmentattempt` (
  `assessmentattemptID` int(11) NOT NULL,
  `employeeID` int(11) NOT NULL,
  `assessmentID` int(11) NOT NULL,
  `questionSet` int(2) NOT NULL,
  `markObtained` int(11) NOT NULL,
  `minuteTaken` varchar(20) NOT NULL,
  `result` varchar(255) NOT NULL,
  `timeStamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assessmentattempt`
--

INSERT INTO `assessmentattempt` (`assessmentattemptID`, `employeeID`, `assessmentID`, `questionSet`, `markObtained`, `minuteTaken`, `result`, `timeStamp`) VALUES
(1, 68, 4, 2, 0, '0:05', 'fail', '2017-06-04 12:03:05'),
(2, 67, 4, 1, 0, '0:05', 'fail', '2017-06-04 12:10:11'),
(3, 67, 4, 2, 0, '0:05', 'fail', '2017-06-08 00:55:14'),
(4, 67, 4, 1, 5, '0:20', 'fail', '2017-06-08 00:55:41'),
(5, 67, 4, 1, 0, '0:41', 'fail', '2017-06-09 00:21:10'),
(6, 67, 4, 2, 0, '0:15', 'fail', '2017-06-09 00:38:55'),
(7, 68, 4, 2, 1, '0:13', 'fail', '2017-06-09 00:39:14'),
(8, 2, 4, 2, 3, '0:56', 'fail', '2017-06-09 00:40:14'),
(9, 67, 4, 1, 0, '0:45', 'fail', '2017-06-25 03:46:32'),
(10, 67, 4, 1, 4, '0:42', 'fail', '2017-06-25 03:47:32'),
(11, 67, 4, 1, 1, '0:24', 'fail', '2017-06-25 03:48:08'),
(12, 67, 4, 2, 0, '0:08', 'fail', '2017-06-25 03:49:24'),
(13, 67, 4, 2, 0, '1:28', 'fail', '2017-07-01 11:50:38'),
(14, 67, 4, 2, 1, '0:07', 'fail', '0000-00-00 00:00:00'),
(15, 67, 4, 2, 3, '0:22', 'fail', '0000-00-00 00:00:00'),
(16, 67, 4, 1, 0, '2:29', 'fail', '2018-08-13 00:00:00'),
(17, 67, 4, 2, 1, '0:17', 'fail', '2018-11-02 00:00:00'),
(18, 67, 4, 1, 1, '0:17', 'fail', '0000-00-00 00:00:00'),
(19, 67, 4, 2, 2, '0:13', 'fail', '2017-07-01 18:27:51');

-- --------------------------------------------------------

--
-- Table structure for table `assessmentquestion`
--

CREATE TABLE `assessmentquestion` (
  `assessmentQuestionID` int(11) NOT NULL,
  `assessmentID` int(11) NOT NULL,
  `question` text NOT NULL,
  `option_1` text,
  `option_2` text,
  `option_3` text,
  `option_4` text,
  `answer` text NOT NULL,
  `weight` int(2) NOT NULL,
  `questionSet` int(2) NOT NULL,
  `timeStamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assessmentquestion`
--

INSERT INTO `assessmentquestion` (`assessmentQuestionID`, `assessmentID`, `question`, `option_1`, `option_2`, `option_3`, `option_4`, `answer`, `weight`, `questionSet`, `timeStamp`) VALUES
(481, 4, '_______ is the consideration or price paid by insured under a contract.', 'true', 'false', '', '', 'true', 1, 1, '2017-06-04 00:48:06'),
(482, 4, 'Which of the following is a contract between the Insurer and the insured wherein insurer agrees to pay hospitalization extent of an agreed sum assured in the event of any medical treatment arising out of an illness or an injury?', 'personal accident policy', 'group accident policy', 'janata person accident', 'health insurance policy', 'health insurance policy', 1, 1, '2017-06-04 00:48:06'),
(483, 4, 'Which of the following means any person who is licensed under the IRDAI Regulations, and is engaged for the purposes of providing health services?', 'third party administrator', 'insurance ombudsman', 'insurer', 'insured', 'insured', 1, 1, '2017-06-04 00:48:06'),
(484, 4, 'Which of the following is the biggest advertisement for an insurance company?', 'door-to-door counseling for insurance', 'obtaining high profile customers', 'settling claims professionally', 'marketing the features of the policy', 'marketing the features of the policy', 1, 1, '2017-06-04 00:48:06'),
(485, 4, 'Investigation and assessment of loss mean the same.', 'false', 'true', '', '', 'true', 1, 1, '2017-06-04 00:48:06'),
(486, 4, 'For which of the following claims, is police report not necessary?', 'cyclone damage', 'burglary', 'accident', 'motor', 'motor', 1, 1, '2017-06-04 00:48:06'),
(487, 4, 'By whom are the claim assessed outside the country, in case of travel insurance polices, assessed?', 'local surveyors in the country of loss', 'claims settling agents named in the policy', 'insurerâ€™s own employees', 'Indian surveyors', 'local surveyors in the country of loss', 1, 1, '2017-06-04 00:48:06'),
(488, 4, 'Which of the following is true of motor insurance?', 'the vehicle should be washed daily', 'the vehicle should not be used for carrying luggage for personal use', 'the vehicle should not be run more than 200 km per day', 'the vehicle should not be used for speed testing', 'the vehicle should not be used for speed testing', 1, 1, '2017-06-04 00:48:06'),
(489, 4, 'Which of the following statement is true?', 'Insurance protects the asset', 'Insurance prevents its loss', 'Insurance reduces possibilities of loss', 'Insurance pays when there is loss of asset', 'Insurance protects the asset', 1, 1, '2017-06-04 00:48:06'),
(490, 4, 'Before acceptance of a risk, the insurer arranges a survey and inspection of the property. Why?', 'To assess the risk for rating purposes', 'To find out how the insured purchased the property', 'To find out whether other insurers have also inspected the property', 'To find out whether neighbouring property also can be insured', 'To find out whether neighbouring property also can be insured', 1, 1, '2017-06-04 00:48:06'),
(491, 4, 'Cost of risk is determined by ________________.', 'Probability only', 'Impact only', 'Probability and impact', 'Timing of risk', 'Timing of risk', 1, 1, '2017-06-04 00:48:06'),
(492, 4, 'Are there any fee/ charges that need to be paid for lodging the complaint with the Ombudsman?', 'A fee of Rs.100 needs to be paid', 'No fee or charges need to be paid', '20% of the relief sought must be paid as fee', '10% of the relief sought must be paid as free', '10% of the relief sought must be paid as free', 1, 1, '2017-06-04 00:48:06'),
(493, 4, 'Which of the below action showcases the principle of â€œUberrima Fidesâ€?', 'Lying about known medical conditions on an insurance proposal form', 'Not revealing known material facts on an insurance proposal form', 'Disclosing known material facts on an insurance proposal form', 'Paying premium on time', 'Paying premium on time', 1, 1, '2017-06-04 00:48:06'),
(494, 4, 'What is the significance of the principle of contribution?', 'It ensures that the insured also contributes a certain portion of the claim along with the insurer', 'It ensures that all the insured who are a part of the pool, contribute to the claim made by a participant of the pool, in the proportion of the premium paid by them', 'It ensures that multiple insurers covering the same subject matter; come together and contribute the claim amount in proportion to their exposure to the subject matter', 'It ensures that the premium is contributed by the insured in equal installments over the year.', 'It ensures that the premium is contributed by the insured in equal installments over the year.', 1, 1, '2017-06-04 00:48:07'),
(495, 4, 'Which of the below statement is correct with regards to renewal notice?', 'As per regulations there is a legal obligation on insurers to send a renewal notice to insured, 30 days before the expiry of the policy', 'As per regulations there is a legal obligation on insurers to send a renewal notice to insured, 15 days before the expiry of the policy', 'As per regulations there is a legal obligation on insurers to send a renewal notice to insured, 7 days before the expiry of the policy', 'As per regulations there is no legal obligation on insurers to send a renewal notice to insured before the expiry of the policy', 'As per regulations there is no legal obligation on insurers to send a renewal notice to insured before the expiry of the policy', 1, 1, '2017-06-04 00:48:07'),
(496, 4, 'Under which principle can the insurer assume the rights of the insured in order to recover from a third party the loss paid under a policy?', 'Contribution', 'Discharge', 'Subrogation', 'Indemnity', 'Contribution', 1, 1, '2017-06-04 00:48:07'),
(497, 4, 'Investigation and assessment of the loss mean the same', 'true', 'false', '', '', 'true', 1, 1, '2017-06-04 00:48:07'),
(498, 4, 'Which of the following statements is true?', 'Insurance is a method of sharing the losses of a â€œfewâ€ by the â€œmanyâ€', 'Insurance is method of transferring the risk of an individual to another individual', 'Insurance is a method of sharing the losses of â€œmanyâ€ by a few', 'Insurance is a method of transferring the gains of a few to the many', 'Insurance is a method of transferring the gains of a few to the many', 1, 1, '2017-06-04 00:48:07'),
(499, 4, 'Which of the below consumer grievance redressal agencies would handle consumer disputes amounting between above Rs.20 lakhs and upto Rs.100 lakhs?', 'District Forum', 'State Commission', 'National Commission', 'Zilla Parishad', 'Zilla Parishad', 1, 1, '2017-06-04 00:48:07'),
(500, 4, 'A customer having complaint regarding his insurance policy can approach IRDAI through', 'District Consumer', 'Forum', 'Ombudsman', 'IGMS', 'IGMS', 1, 1, '2017-06-04 00:48:07'),
(501, 4, 'Which element of a valid contract deals with premium?', 'Offer and acceptance', 'Consideration', 'Free consent', 'Capacity of parties to contract', 'Capacity of parties to contract', 1, 1, '2017-06-04 00:48:07'),
(502, 4, 'If there is no insurable interest the insurance contract becomes', 'unenforceable in a Court of Law', 'illegal', 'void', 'voidable', 'unenforceable in a Court of Law', 1, 1, '2017-06-04 00:48:07'),
(503, 4, '__________________ means transfer of all rights and remedies, with respect to the subject matter of insurance, from insured to insurer.', 'Contribution', 'Subrogation', 'Legal hazard', 'Risk pooling', 'Risk pooling', 1, 1, '2017-06-04 00:48:07'),
(504, 4, 'Which of the following principles prevents an insured from making a profit out of his loss?', 'Proximate cause', 'Pro-rate average', 'Indemnity', 'Insurable interest', 'Insurable interest', 1, 1, '2017-06-04 00:48:07'),
(505, 4, 'Under the Motor Vehicles Act, the fixed compensation for death in â€˜hit and runâ€™ motor accident is Rs. _______', 'Rs. 12,500/-', 'Rs. 25,000/-', 'Rs. 50,000/-', 'Rs. 1,00,000/-', 'Rs. 1,00,000/-', 1, 1, '2017-06-04 00:48:07'),
(506, 4, 'Who among the following is considered as primary stakeholder in insurance claim process?', 'Customers', 'Owners', 'Underwriters', 'Insurance agents/brokers', 'Insurance agents/brokers', 1, 1, '2017-06-04 00:48:07'),
(507, 4, 'Which of the following means any person who is licensed under the IRDA Regulations, and is engaged for the purposes of providing health services?', 'third party administrator', 'insured', 'insurance ombudsman', 'insurer', 'insurer', 1, 1, '2017-06-04 00:48:07'),
(508, 4, 'Which of the following does House Holder''s Insurance cover? Select the correct option.', 'both the structure and contents', 'only the structure of the home', 'both structure and contents only when insured is not at home', 'only the contents of the home', 'only the contents of the home', 1, 1, '2017-06-04 00:48:07'),
(509, 4, 'Which of the following principles of law prevents an insured from making a profit out of his loss?', 'Insurable interest', 'Caveat Emptor', 'Utmost goodfaith', 'Indemnity', 'Indemnity', 1, 1, '2017-06-04 00:48:07'),
(510, 4, 'The Insurance under Overseas Mediclaim Policy does not operate beyond _____________days of continuous absence from India.', '60', '90', '120', '180', '180', 1, 1, '2017-06-04 00:48:07'),
(511, 4, '_______ is the consideration or price paid by insured under a contract.', 'Claim amount', 'Surrender value', 'Maturity amount', 'Premium', 'Claim amount', 1, 2, '2017-06-04 00:48:07'),
(512, 4, 'Which of the following is a contract between the Insurer and the insured wherein insurer agrees to pay hospitalization extent of an agreed sum assured in the event of any medical treatment arising out of an illness or an injury?', 'personal accident policy', 'group accident policy', 'janata person accident', 'health insurance policy', 'health insurance policy', 1, 2, '2017-06-04 00:48:07'),
(513, 4, 'Which of the following means any person who is licensed under the IRDAI Regulations, and is engaged for the purposes of providing health services?', 'third party administrator', 'insurance ombudsman', 'insurer', 'insured', 'insured', 1, 2, '2017-06-04 00:48:07'),
(514, 4, 'Which of the following is the biggest advertisement for an insurance company?', 'door-to-door counseling for insurance', 'obtaining high profile customers', 'settling claims professionally', 'marketing the features of the policy', 'marketing the features of the policy', 1, 2, '2017-06-04 00:48:07'),
(515, 4, 'Investigation and assessment of loss mean the same.', 'true', 'false', '', '', 'true', 1, 2, '2017-06-04 00:48:07'),
(516, 4, 'For which of the following claims, is police report not necessary?', 'cyclone damage', 'burglary', 'accident', 'motor', 'motor', 1, 2, '2017-06-04 00:48:07'),
(517, 4, 'By whom are the claim assessed outside the country, in case of travel insurance polices, assessed?', 'local surveyors in the country of loss', 'claims settling agents named in the policy', 'insurerâ€™s own employees', 'Indian surveyors', 'Indian surveyors', 1, 2, '2017-06-04 00:48:07'),
(518, 4, 'Which of the following is true of motor insurance?', 'the vehicle should be washed daily', 'the vehicle should not be used for carrying luggage for personal use', 'the vehicle should not be run more than 200 km per day', 'the vehicle should not be used for speed testing', 'the vehicle should not be used for speed testing', 1, 2, '2017-06-04 00:48:07'),
(519, 4, 'Which of the following statement is true?', 'Insurance protects the asset', 'Insurance prevents its loss', 'Insurance reduces possibilities of loss', 'Insurance pays when there is loss of asset', 'Insurance pays when there is loss of asset', 1, 2, '2017-06-04 00:48:08'),
(520, 4, 'Before acceptance of a risk, the insurer arranges a survey and inspection of the property. Why?', 'To assess the risk for rating purposes', 'To find out how the insured purchased the property', 'To find out whether other insurers have also inspected the property', 'To find out whether neighbouring property also can be insured', 'To find out whether neighbouring property also can be insured', 1, 2, '2017-06-04 00:48:08'),
(521, 4, 'Cost of risk is determined by ________________.', 'Probability only', 'Impact only', 'Probability and impact', 'Timing of risk', 'Timing of risk', 1, 2, '2017-06-04 00:48:08'),
(522, 4, 'Are there any fee/ charges that need to be paid for lodging the complaint with the Ombudsman?', 'A fee of Rs.100 needs to be paid', 'No fee or charges need to be paid', '20% of the relief sought must be paid as fee', '10% of the relief sought must be paid as free', '10% of the relief sought must be paid as free', 1, 2, '2017-06-04 00:48:08'),
(523, 4, 'Which of the below action showcases the principle of â€œUberrima Fidesâ€?', 'Lying about known medical conditions on an insurance proposal form', 'Not revealing known material facts on an insurance proposal form', 'Disclosing known material facts on an insurance proposal form', 'Paying premium on time', 'Paying premium on time', 1, 2, '2017-06-04 00:48:08'),
(524, 4, 'What is the significance of the principle of contribution?', 'It ensures that the insured also contributes a certain portion of the claim along with the insurer', 'It ensures that all the insured who are a part of the pool, contribute to the claim made by a participant of the pool, in the proportion of the premium paid by them', 'It ensures that multiple insurers covering the same subject matter; come together and contribute the claim amount in proportion to their exposure to the subject matter', 'It ensures that the premium is contributed by the insured in equal installments over the year.', 'It ensures that the premium is contributed by the insured in equal installments over the year.', 1, 2, '2017-06-04 00:48:08'),
(525, 4, 'Which of the below statement is correct with regards to renewal notice?', 'As per regulations there is a legal obligation on insurers to send a renewal notice to insured, 30 days before the expiry of the policy', 'As per regulations there is a legal obligation on insurers to send a renewal notice to insured, 15 days before the expiry of the policy', 'As per regulations there is a legal obligation on insurers to send a renewal notice to insured, 7 days before the expiry of the policy', 'As per regulations there is no legal obligation on insurers to send a renewal notice to insured before the expiry of the policy', 'As per regulations there is no legal obligation on insurers to send a renewal notice to insured before the expiry of the policy', 1, 2, '2017-06-04 00:48:08'),
(526, 4, 'Under which principle can the insurer assume the rights of the insured in order to recover from a third party the loss paid under a policy?', 'Contribution', 'Discharge', 'Subrogation', 'Indemnity', 'Indemnity', 1, 2, '2017-06-04 00:48:08'),
(527, 4, 'Investigation and assessment of the loss mean the same', 'true', 'false', '', '', 'true', 1, 2, '2017-06-04 00:48:08'),
(528, 4, 'Which of the following statements is true?', 'Insurance is a method of sharing the losses of a â€œfewâ€ by the â€œmanyâ€', 'Insurance is method of transferring the risk of an individual to another individual', 'Insurance is a method of sharing the losses of â€œmanyâ€ by a few', 'Insurance is a method of transferring the gains of a few to the many', 'Insurance is a method of transferring the gains of a few to the many', 1, 2, '2017-06-04 00:48:08'),
(529, 4, 'Which of the below consumer grievance redressal agencies would handle consumer disputes amounting between above Rs.20 lakhs and upto Rs.100 lakhs?', 'District Forum', 'State Commission', 'National Commission', 'Zilla Parishad', 'Zilla Parishad', 1, 2, '2017-06-04 00:48:08'),
(530, 4, 'A customer having complaint regarding his insurance policy can approach IRDAI through', 'District Consumer', 'Forum', 'Ombudsman', 'IGMS', 'IGMS', 1, 2, '2017-06-04 00:48:08'),
(531, 4, 'Which element of a valid contract deals with premium?', 'Offer and acceptance', 'Consideration', 'Free consent', 'Capacity of parties to contract', 'Capacity of parties to contract', 1, 2, '2017-06-04 00:48:08'),
(532, 4, 'If there is no insurable interest the insurance contract becomes', 'unenforceable in a Court of Law', 'illegal', 'void', 'voidable', 'voidable', 1, 2, '2017-06-04 00:48:08'),
(533, 4, '__________________ means transfer of all rights and remedies, with respect to the subject matter of insurance, from insured to insurer.', 'Contribution', 'Subrogation', 'Legal hazard', 'Risk pooling', 'Subrogation', 1, 2, '2017-06-04 00:48:08'),
(534, 4, 'Which of the following principles prevents an insured from making a profit out of his loss?', 'Proximate cause', 'Pro-rate average', 'Indemnity', 'Insurable interest', 'Insurable interest', 1, 2, '2017-06-04 00:48:08'),
(535, 4, 'Under the Motor Vehicles Act, the fixed compensation for death in â€˜hit and runâ€™ motor accident is Rs. _______', 'Rs. 12,500/-', 'Rs. 25,000/-', 'Rs. 50,000/-', 'Rs. 1,00,000/-', 'Rs. 1,00,000/-', 1, 2, '2017-06-04 00:48:08'),
(536, 4, 'Who among the following is considered as primary stakeholder in insurance claim process?', 'Customers', 'Owners', 'Underwriters', 'Insurance agents/brokers', 'Insurance agents/brokers', 1, 2, '2017-06-04 00:48:08'),
(537, 4, 'Which of the following means any person who is licensed under the IRDA Regulations, and is engaged for the purposes of providing health services?', 'third party administrator', 'insured', 'insurance ombudsman', 'insurer', 'insurer', 1, 2, '2017-06-04 00:48:08'),
(538, 4, 'Which of the following does House Holder''s Insurance cover? Select the correct option.', 'both the structure and contents', 'only the structure of the home', 'both structure and contents only when insured is not at home', 'only the contents of the home', 'only the contents of the home', 1, 2, '2017-06-04 00:48:08'),
(539, 4, 'Which of the following means any person who is licensed under the IRDA Regulations, and is engaged for the purposes of providing health services?', 'third party administrator', 'insured', 'insurance ombudsman', 'insurer', 'insurer', 1, 2, '2017-06-04 00:48:08'),
(540, 4, 'Which of the following does House Holder''s Insurance cover? Select the correct option.', 'both the structure and contents', 'only the structure of the home', 'both structure and contents only when insured is not at home', 'only the contents of the home', 'only the contents of the home', 1, 2, '2017-06-04 00:48:08');

-- --------------------------------------------------------

--
-- Table structure for table `chepter`
--

CREATE TABLE `chepter` (
  `chepterID` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `courseID` int(11) NOT NULL,
  `description` text NOT NULL,
  `timeStamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chepter`
--

INSERT INTO `chepter` (`chepterID`, `title`, `courseID`, `description`, `timeStamp`) VALUES
(1, 'What Is Financial Activities', 2, 'This is about financial activities, we are describing here each and every activity of finance', '2017-06-03 08:59:07'),
(3, 'dfgdfh', 5, 'fgdfgdfggf', '2017-07-02 01:57:48');

-- --------------------------------------------------------

--
-- Table structure for table `chepterquestion`
--

CREATE TABLE `chepterquestion` (
  `chepterquestionID` int(11) NOT NULL,
  `chepterID` int(11) NOT NULL,
  `question` text NOT NULL,
  `option_1` text NOT NULL,
  `option_2` text NOT NULL,
  `option_3` text NOT NULL,
  `option_4` text NOT NULL,
  `answer` text NOT NULL,
  `explanation` text NOT NULL,
  `timeStamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chepterquestion`
--

INSERT INTO `chepterquestion` (`chepterquestionID`, `chepterID`, `question`, `option_1`, `option_2`, `option_3`, `option_4`, `answer`, `explanation`, `timeStamp`) VALUES
(1, 1, 'xdfgdfh fhd hfg hfdgh dfh dfgh df', 'Adsfsd', '114433', 'Ajeet Singh', 'Developer', 'Adsfsd', 'sdf zdf sd fs fssdfsdfsdf sdd sdf  sdfsdf s', '2017-06-03 12:19:06'),
(2, 1, 'We are looking for _____________ search engine', 'true', 'false', '', '', 'false', 'Test question with two options', '2017-06-03 12:19:06'),
(3, 1, 'New question 3 having answer', 'test option 1', '114433', 'Ajeet Singh', 'Developer', 'Developer', 'sdf zdf sd fs fssdfsdfsdf sdd sdf  sdfsdf s', '2017-06-03 12:19:06'),
(4, 1, 'ADAS ASDS FSDas fsdgdfg dff gsd', '9990092901', '114433', 'Ajeet Singh', 'Developer', '9990092901', 'sdf zdf sd fs fssdfsdfsdf sdd sdf  sdfsdf s', '2017-06-03 12:19:06'),
(5, 1, 'What is the different between .msi and .zip blender download file?', 'MSI File is executable file, and .zip is compressed file', 'both are compressed version of file', 'both are identical file', 'none of these', 'none of these', 'I am trying to set up this plugin with my project http://plugins.krajee.com/file-', '2017-06-03 12:19:06');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `companyID` int(11) NOT NULL,
  `name` text NOT NULL,
  `contactName` varchar(255) NOT NULL,
  `contactMobile` varchar(255) NOT NULL,
  `contactEmail` varchar(255) NOT NULL,
  `timeStamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`companyID`, `name`, `contactName`, `contactMobile`, `contactEmail`, `timeStamp`) VALUES
(1, 'IC-38', 'J. M. Sawhney', '9810500469', 'sawhneyjm@gmail.com', '2017-06-02 00:07:43'),
(2, 'test', 'test', '3445567889', 'test@dfghfgj.fhf', '2017-12-10 21:53:41');

-- --------------------------------------------------------

--
-- Table structure for table `companycourse`
--

CREATE TABLE `companycourse` (
  `companycourseID` int(11) NOT NULL,
  `companyID` int(11) NOT NULL,
  `courseID` int(11) NOT NULL,
  `timeStamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `companycourse`
--

INSERT INTO `companycourse` (`companycourseID`, `companyID`, `courseID`, `timeStamp`) VALUES
(2, 1, 2, '2017-06-03 12:43:57'),
(17, 1, 5, '2017-07-01 16:21:54'),
(18, 2, 5, '2017-12-10 21:54:13');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `courseID` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `departmentID` int(11) NOT NULL,
  `duration` varchar(9) DEFAULT NULL,
  `maxDays` int(11) NOT NULL,
  `timeStamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`courseID`, `title`, `description`, `departmentID`, `duration`, `maxDays`, `timeStamp`) VALUES
(2, 'Point of Sales Person (POSP)', 'Admin can edit this course anytime..', 1, '15:00:00', 30, '2017-06-03 08:51:04'),
(5, 'Test Course for', 'Test Description of the course', 1, '15:00:00', 30, '2017-07-01 16:20:22');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `departmentID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `timeStamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`departmentID`, `name`, `description`, `timeStamp`) VALUES
(1, 'Non-Life and Health Insurance', 'To manage financial activities', '2017-06-02 00:08:25');

-- --------------------------------------------------------

--
-- Table structure for table `documentation`
--

CREATE TABLE `documentation` (
  `documentationID` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(400) NOT NULL,
  `content` text NOT NULL,
  `sourceLocation` enum('admin','employee','web') NOT NULL DEFAULT 'admin',
  `addedBy` int(11) NOT NULL,
  `timeStamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employeeID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `employeeCode` varchar(255) NOT NULL,
  `managerName` varchar(255) DEFAULT NULL,
  `departmentID` int(11) NOT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `address` text,
  `panCard` varchar(255) DEFAULT NULL,
  `aadharCard` varchar(255) DEFAULT NULL,
  `companyID` int(11) NOT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `representative` tinyint(1) NOT NULL DEFAULT '0',
  `password` varchar(500) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `firstLogin` datetime DEFAULT NULL,
  `timeStamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employeeID`, `name`, `email`, `mobile`, `employeeCode`, `managerName`, `departmentID`, `designation`, `address`, `panCard`, `aadharCard`, `companyID`, `role`, `representative`, `password`, `status`, `firstLogin`, `timeStamp`) VALUES
(2, 'Vijay Kumar', 'vijay@hrd.com', '7042391949', '11407', 'Rupesh Agrawal', 0, 'Sr. Associate', 'C3/108, Panchsheel Green II', 'CDLPK2758P', 'S23UP0GMASDD', 33, 'admin', 0, '74a7ae052a4ade0fc93d6a945c856b82', 'active', NULL, '2017-05-21 04:13:49'),
(16, 'Ajay Kumar', 'admin@bricksadvisors.com', '7042391949', '11407', 'Self', 0, 'Associate 2', 'C3/108, Supertech Ecovillage II', 'CDLPK2758P', '123123123123', 34, 'admin', 1, '74a7ae052a4ade0fc93d6a945c856b82', 'active', '0000-00-00 00:00:00', '2017-05-24 22:42:21'),
(67, 'Akshit Chaudhary', 'ajaykiet2@gmail.com', '7042391949', '00001', 'Manager Rupesh', 1, 'asds sa d as as asdas dasd as', 'Qwerty lkjhg asdf', 'DCFGH4567I', '234234456456', 1, 'user', 0, '74a7ae052a4ade0fc93d6a945c856b82', 'active', '0000-00-00 00:00:00', '2017-06-01 00:33:54'),
(68, 'Ajay Kumar', 'ajay@hrd.com', '7042391949', '110076', 'Ajeet Singh', 1, 'Associate', 'C3/108, Supertech Ecovillage II', 'CDLPK3498W', '345987165457', 1, 'user', 0, 'f7640437662616371e81edab24079579', 'active', '0000-00-00 00:00:00', '2017-06-04 10:55:34');

-- --------------------------------------------------------

--
-- Table structure for table `employeeassessment`
--

CREATE TABLE `employeeassessment` (
  `employeeassessmentID` int(11) NOT NULL,
  `employeeID` int(11) NOT NULL,
  `assessmentID` int(11) NOT NULL,
  `attempts` int(2) NOT NULL,
  `timeTaken` varchar(255) NOT NULL,
  `maxScore` int(11) NOT NULL,
  `result` enum('fail','pass') NOT NULL,
  `attemptDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employeecourse`
--

CREATE TABLE `employeecourse` (
  `employeecourseID` int(11) NOT NULL,
  `courseID` int(11) NOT NULL,
  `employeeID` int(11) NOT NULL,
  `timeSpent` varchar(9) NOT NULL DEFAULT '00:00:00',
  `eligiblity` enum('yes','no') NOT NULL DEFAULT 'no',
  `timeStamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('new','started','finished') NOT NULL DEFAULT 'new'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employeecourse`
--

INSERT INTO `employeecourse` (`employeecourseID`, `courseID`, `employeeID`, `timeSpent`, `eligiblity`, `timeStamp`, `status`) VALUES
(2, 2, 67, '05:30:07', 'yes', '2017-06-03 12:43:57', 'started'),
(26, 5, 67, '00:00:25', 'no', '2017-07-01 16:21:55', 'started'),
(27, 5, 67, '00:00:00', 'no', '2017-12-10 21:54:14', 'new');

-- --------------------------------------------------------

--
-- Table structure for table `enquiry`
--

CREATE TABLE `enquiry` (
  `enquiryID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `timeStamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `faqID` int(11) NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `likes` int(11) NOT NULL DEFAULT '0',
  `dislike` int(11) NOT NULL DEFAULT '0',
  `timeStamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`faqID`, `question`, `answer`, `likes`, `dislike`, `timeStamp`) VALUES
(1, 'What Is the fee of Registration and Examination?', 'Total Registration and Examination fee is Rs. 500 /- ( Fee of Rs.437/- plus 14.5% service tax )', 0, 0, '2017-05-17 01:00:23'),
(3, 'What documents need to be submitting along with the examination form?', 'No documents are required to be submit at NIEUT Centre.', 0, 0, '2017-05-17 01:02:40'),
(4, 'What Is mode of examination fee to be paid in case of Online Examination form?', 'The candidate/institute make the payment through the following modes : -\r\ni) Online (Credit/ Debit card/ Netbanking)\r\nii) NEFT\r\niii) CSC-SPV', 0, 0, '2017-05-17 01:02:58'),
(5, 'From where can I get the details of Regional Centre?', 'The details of Regional Centre vis-a-vis state are available on the website of NIELIT\r\nhttp://www.nielit.ciov.iNstudent411ccc.htm .', 0, 0, '2017-05-17 01:03:14'),
(6, 'How many papers are there in POS examination?', 'Only 1 paper.', 0, 0, '2017-05-17 01:03:30'),
(7, 'What are the minimum marks required to qualify POS examination successfully?', '35 marks out of 100 are the minimum marks required to pass this exam.', 0, 0, '2017-05-17 01:03:46'),
(8, 'What is the mode of examination?', 'The examination is conducted in Online mode i.e. no pen/penciVpaper is required.', 0, 0, '2017-05-17 01:04:03'),
(9, 'How many questions to be attempt and what is the duration of examination?', 'The Question Paper comprises of 100 objective type questions of 1 mark each, and the candidate is required to attempt the 100 questions in 60 minutes. There is no negative marking.', 0, 0, '2017-05-17 02:21:48'),
(12, 'How I can get the confirmation that my examination form for POS has been processed?', 'The Candidate can check the status at http://student.nielitoov.in', 0, 0, '2017-05-17 02:22:33');

-- --------------------------------------------------------

--
-- Table structure for table `forgotpassword`
--

CREATE TABLE `forgotpassword` (
  `id` int(11) NOT NULL,
  `employeeID` int(11) NOT NULL,
  `token` text NOT NULL,
  `timeStamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `shortDescription` text NOT NULL,
  `fullDescription` text NOT NULL,
  `image` text,
  `timeStamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `title`, `name`, `shortDescription`, `fullDescription`, `image`, `timeStamp`) VALUES
(4, 'Tells the image processing', 'Specifies what to use', 'Specifies what to use as the master axis when resizing or creating thumbs. For example, let’s say you want to resize an image to 100 X 75 pixels. If the source image size does not allow perfect resizing to those dimensions,', 'If you prefer not to set preferences using the above method, you can instead put them into a config file. Simply create a new file called image_lib.php, add the $config array in that file. Then save the file in config/image_lib.php and it will be used automatically. You will NOT need to use the $this->image_lib->initialize() method if you save your preferences in a config file. If you prefer not to set preferences using the above method, you can instead put them into a config file. Simply create a new file called image_lib.php, add the $config array in that file. Then save the file in config/image_lib.php and it will be used automatically. You will NOT need to use the $this->image_lib->initialize() method if you save your preferences in a config file.', '4.jpg', '2017-07-03 01:25:59'),
(5, 'Overflow Community', 'Important Questions', 'It also caters to the information building and dissemination of knowledge and skills to managers in insurance industry, banks, broking companies and call centers.\r\n\r\nThe Foundation is a non-profit body registered as a TRUST.', 'It also caters to the information building and dissemination of knowledge and skills to managers in insurance industry, banks, broking companies and call centers.\r\n\r\nThe Foundation is a non-profit body registered as a TRUST.It also caters to the information building and dissemination of knowledge and skills to managers in insurance industry, banks, broking companies and call centers.\r\n\r\nThe Foundation is a non-profit body registered as a TRUST.It also caters to the information building and dissemination of knowledge and skills to managers in insurance industry, banks, broking companies and call centers.\r\n\r\nThe Foundation is a non-profit body registered as a TRUST.It also caters to the information building and dissemination of knowledge and skills to managers in insurance industry, banks, broking companies and call centers.\r\n\r\nThe Foundation is a non-profit body registered as a TRUST.It also caters to the information building and dissemination of knowledge and skills to managers in insurance industry, banks, broking companies and call centers.\r\n\r\nThe Foundation is a non-profit body registered as a TRUST.', '5.jpg', '2017-07-03 02:04:15'),
(6, 'Title number 3', 'We are doing good', 'anies and call centers. The Foundation is a non-profit body registered as a TRUST.It also caters to the information building and dissemination of knowledge and skills to managers in in', 'anies and call centers. The Foundation is a non-profit body registered as a TRUST.It also caters to the information building and dissemination of knowledge and skills to managers in insurance industry, banks, broking companies and call centers. The Foundation is a non-profit body registered as a TRUST.It also caters to the information building and dissemination of knowledge and skills to managers in insurance industry, banks, broking companies and call centers. The Foundation is a non-profit body registered as a TRUST.It also caters to the information building and dissemination of knowledge and skills to managers in insurance industry, banks, broking companies and call centers. The Foundation is a non-profit body registered as a TRUST.It also caters tanies and call centers. The Foundation is a non-profit body registered as a TRUST.It also caters to the information building and dissemination of knowledge and skills to managers in insurance industry, banks, broking companies and call centers. The Foundation is a non-profit body registered as a TRUST.It also caters to the information building and dissemination of knowledge and skills to managers in insurance industry, banks, broking companies and call centers. The Foundation is a non-profit body registered as a TRUST.It also caters to the information building and dissemination of knowledge and skills to managers in insurance industry, banks, broking companies and call centers. The Foundation is a non-profit body registered as a TRUST.It also caters t', '6.jpg', '2017-07-03 02:09:47'),
(7, 'NIELIT Collaboration', 'Collaboration Community', 'Dr. M.M. Anand\r\nEx-Dean & Professor of Marketing, Faculty of Management Studies, University of DelhiDr. M.M. Anand\r\nEx-Dean & Professor of Marketing', 'Dr. M.M. Anand\r\nEx-Dean & Professor of Marketing, Faculty of Management Studies, University of DelhiDr. M.M. Anand\r\nEx-Dean & Professor of Marketing, Faculty of Management Studies, University of DelhiDr. M.M. Anand\r\nEx-Dean & Professor of Marketing, Faculty of Management Studies, University of DelhiDr. M.M. Anand\r\nEx-Dean & Professor of Marketing, Faculty of Management Studies, University of DelhiDr. M.M. Anand\r\nEx-Dean & Professor of Marketing, Faculty of Management Studies, University of DelhiDr. M.M. Anand\r\nEx-Dean & Professor of Marketing, Faculty of Management Studies, University of DelhiDr. M.M. Anand\r\nEx-Dean & Professor of Marketing, Faculty of Management Studies, University of DelhiDr. M.M. Anand\r\nEx-Dean & Professor of Marketing, Faculty of Management Studies, University of DelhiDr. M.M. Anand\r\nEx-Dean & Professor of Marketing, Faculty of Management Studies, University of DelhiDr. M.M. Anand\r\nEx-Dean & Professor of Marketing, Faculty of Management Studies, University of DelhiDr. M.M. Anand\r\nEx-Dean & Professor of Marketing, Faculty of Management Studies, University of Delhi', '7.png', '2017-07-06 01:10:52'),
(8, 'Training Strategy', 'Training Strategy Name', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '8.png', '2017-07-06 01:13:02'),
(9, 'Puzzle Solution', 'Puzzle Name', 'It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '9.png', '2017-07-06 01:14:01'),
(10, 'HRD Connectivity', 'HRD India', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '10.png', '2017-07-06 01:16:56'),
(11, 'Title number', 'Title Name', 'And more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '11.png', '2017-07-06 01:18:29'),
(12, 'Efforts', 'Efforts Name', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don''t look even slightly believable.', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don''t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn''t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet.\r\n\r\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don''t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn''t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet.\r\n\r\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don''t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn''t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet.', '12.png', '2017-07-06 01:22:08'),
(13, 'Implementation', 'Name Of Implementation', 'All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet.', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don''t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn''t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet.There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don''t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn''t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet.There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don''t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn''t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet.There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don''t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn''t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet.There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don''t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn''t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet.', '13.png', '2017-07-06 01:22:49'),
(14, 'Teaching', 'Project Training', 'All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet.', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don''t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn''t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet.There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don''t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn''t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet.There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don''t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn''t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet.There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don''t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn''t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet.', '14.png', '2017-07-06 01:23:47'),
(15, 'Sharp Minded', 'Person Name', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don''t look even slightly believable.', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don''t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn''t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don''t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn''t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet.don''t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn''t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet.', '15.jpg', '2017-07-06 01:24:36');

-- --------------------------------------------------------

--
-- Table structure for table `glossary`
--

CREATE TABLE `glossary` (
  `glossaryID` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `timeStamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `glossary`
--

INSERT INTO `glossary` (`glossaryID`, `title`, `description`, `timeStamp`) VALUES
(3, 'Act of God', 'Natural events which are beyond the control of a human being and occur without intervention of a human being. It is difficult to prevent the occurrence with any amount of foresight, plans or reasonable care. For example: earthquake, lightning, storm etc.', '2017-07-05 01:17:08'),
(4, 'Actuary', 'An insurance professional who specializes in statistical information.', '2017-07-05 01:17:22'),
(5, 'All Risks', 'Term used to describe insurance against loss of or damage to property arising from any accidental reason except those that are specifically excluded.', '2017-07-05 01:17:37'),
(6, 'Assignment', 'The transfer of ownership of a life insurance policy from one person to another. Also refers to the document that effects the transfer.', '2017-07-05 01:17:52'),
(7, 'Average (Condition of Average)', 'A clause in insurance policies in which loss payable is reduced because the insured has taken lesser insurance than insurable value. It is paid proportionately. Loss X sum insured / Market value.', '2017-07-05 01:18:14'),
(8, 'Beneficiary', 'The named person who receives the benefits of the policy upon the death of the policyholder.', '2017-07-05 01:18:30'),
(9, 'Cashless facility', '"Cashless facility" means a facility extended by the insurer to the insured where the payments of the costs of treatment undergone by the insured in accordance with the policy terms and conditions, are directly made to the network provider by the insurer to the extent of pre-authorization approved.', '2017-07-05 01:18:59'),
(10, 'Claims', 'Injury or loss to the insured arising due to an insured event for which the insurer is liable to pay the compensation as per terms of cover given.', '2017-07-05 01:19:22'),
(11, 'Commercial lines', 'Insurance products that are designed for and bought by businesses as opposed to personal lines products, which are sold to individuals.', '2017-07-05 01:19:37'),
(12, 'Commission', 'The fee paid to the insurance salesperson, as a percentage of the policy premium.', '2017-07-05 01:20:03'),
(13, 'Concealment', 'Hiding of any important information connected with the risk to be insured with a view to taking insurance.', '2017-07-05 01:20:23'),
(14, 'Conditions', 'Part of every insurance policy; qualify the various promises made by insurance company.', '2017-07-05 01:20:46'),
(15, 'Consequential Loss', 'Losses which are indirect to an event insured. Like fire in a factory closes it down with the result loss of production takes place. Loss of production is a Consequential Loss. Generally it is excluded from specific policy but can be covered under a separate policy.', '2017-07-05 01:21:05'),
(16, 'Contribution', 'Contribution is essentially the right of an insurer to call upon other insurers, liable to the same insured, to share the cost of an indemnity claim on a ratable proportion.', '2017-07-05 01:21:45'),
(17, 'Co-Payment', 'A co-payment is a cost -sharing requirement under a health insurance policy that provides that the policyholder/insured will bear a specified percentage of the admissible costs. A co-payment does not reduce the sum insured.', '2017-07-05 01:22:09'),
(18, 'Cover Note', 'A document issued to the insured confirming the granting of insurance. Generally this is issued pending issue of the policy by insurers.', '2017-07-05 01:22:31'),
(19, 'Cumulative Bonus', 'Cumulative Bonus shall mean any increase in the sum assured/ Malus granted by the insurer without an associated increase in premium.', '2017-07-05 01:23:02');

-- --------------------------------------------------------

--
-- Table structure for table `guidline`
--

CREATE TABLE `guidline` (
  `guidlineID` int(11) NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `timeStamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guidline`
--

INSERT INTO `guidline` (`guidlineID`, `title`, `content`, `timeStamp`) VALUES
(9, 'IRDAI TRAINING GUIDELINES', '<p style="text-align: center;"><strong><span style="font-size: 18px;">INSURANCE REGULATORY AND DEVELOPMENT AUTHORITY OF INDIA</span></strong></p><p style="text-align: center;"><span style="font-size: 24px;"><strong><span style="color: rgb(65, 168, 95);">NOTIFI</span><span style="color: rgb(184, 49, 47);">CATION</span></strong></span></p><p style="text-align: center;"><span style="font-size: 14px;">Hyderabad, the 5<sup>th</sup> May, 2017</span></p><p style="text-align: center;"><strong><span style="font-size: 12px;">Insurance Regulatory and Development Authority of India&nbsp;</span></strong></p><p style="text-align: center;"><strong><span style="font-size: 12px;">(Insurance Surveyors and Loss Assessors) (First Amendment) Regulations, 2017</span></strong></p><p style="text-align: justify;"><span style="font-size: 12px;"><strong>F. No. IRDAI/Reg/7/144/2017 -</strong> In exercise of the powers conferred by Sections 42D, 42E, 6 4 UM and 114A of the Insurance Act, 1938 read with 14 and 26 of the Insurance Regulatory and Development Authority Act, 1999 (41 of 1999), the Authority, in consultation with the Insurance Advisory Committee, hereby makes the following amendments to Insurance Regulatory and Development Authority of India (Insurance Surveyors and Loss Assessors) Regulations, 2015, namely:&mdash;</span></p><ol><li><span style="font-size: 12px;">&nbsp; Short title and commencement: -&nbsp;</span></li></ol><ul><li style="margin-left: 40px;"><span style="font-size: 12px;">&nbsp;These regulations may be called Insurance Regulatory and Development Authority of India (Insurance Surveyors and Loss Assessors) (First Amendment) Regulations, 2017. &nbsp;</span></li><li style="margin-left: 40px;"><span style="font-size: 12px;">They shall come into force on the date of their publication in the Official Gazette</span></li></ul><p>&nbsp; &nbsp; &nbsp; &nbsp; 2. In the Insurance Regulatory and Development Authority of India (Insurance Surveyors and Loss Assessors) Regulations, 2015</p><ol><li>In Reg. 3(2)(c), after the words ?is exempt from taking examination once again stated under 3(2)(c) above?, the words ?subject to Reg.3(8)(c)? shall be inserted.&nbsp;</li><li>After Reg.3(8)(b), a new clause (c) shall be inserted as under: Reg. 3 (8)(c): The application for license shall be submitted within a period of 5 years from the date of enrolment after meeting the requirements. Provided that those who have enrolled as trainees with the Authority as on the date of notification of these Regulations, shall apply for license after meeting the requirements within one year from the date of notification or 5 years from the date of enrolment, whichever is later.&nbsp;</li><li>Reg. 6(3) (a)(v) shall be amended as under: Proof of qualification (notarized) or categorization letter issued by the Authority stating the eligible Departments in accordance with the categorization made vide IRDA/Order/SLA/30/3/2002 dated 30th March, 2002.&nbsp;</li><li><strong>Reg. 17(3) shall be substituted as under:&nbsp;</strong>The licensed surveyor who provides training should have held a valid license to act as Surveyor and Loss Assessor in that particular department for the last 8 years.</li></ol><p><br></p><p style="text-align: center;"><strong>IRDAI (Insurance Surveyors and Loss Assessors) Regulations, 2015</strong></p><p style="text-align: center;"><strong><u>Qualification Criteria for Enrolment and Licensing of Surveyors and Loss Assessors (Regulation 3)</u></strong></p><table style="width: 100%;"><thead><tr><th class="fr-thick" style="width: 4.8157%; text-align: center; background-color: rgb(41, 105, 176);"><span style="color: rgb(255, 255, 255);">S.No</span></th><th class="fr-thick" style="width: 17.847%; text-align: left; background-color: rgb(41, 105, 176);"><span style="color: rgb(255, 255, 255);">Department</span></th><th class="fr-thick " style="background-color: rgb(41, 105, 176); width: 77.1483%;"><span style="color: rgb(255, 255, 255);">Academic/technical/Professional/Insurance Qualifications</span></th></tr></thead><tbody><tr><td class="fr-thick" style="width: 4.8157%; text-align: center; background-color: rgb(209, 72, 65);">1</td><td class="fr-thick " style="width: 17.847%; background-color: rgb(209, 72, 65);">Fire</td><td class="fr-thick" style="width: 77.1483%; background-color: rgb(209, 72, 65);"><span style="color: rgb(255, 255, 255);">B.E./ B. Tech./ B.Sc. (Engg.)/ A.M.I.E. or its equivalent, C.A./ I.C.W.A., A.I.I.I./ F.I.I.I./Post Graduate Diploma in Insurance from IIRM</span></td></tr><tr><td class="fr-thick " style="width: 4.8157%; text-align: center; background-color: rgb(209, 72, 65);">2</td><td class="fr-thick fr-highlighted " style="width: 17.847%; background-color: rgb(209, 72, 65);">Marine Cargo</td><td class="fr-thick fr-highlighted" style="width: 77.1483%; background-color: rgb(209, 72, 65);"><span style="color: rgb(247, 218, 100);">B.E./ B.Tech./ B.Sc. (Engg.)/ A.M.I.E. or its equivalent thereof (Marine Engineering/ Naval Architecture),/ certificate of competency as Master of Ship or as First Class Marine Engineer issued by a recognized authority, Degree or diploma in Naval Architecture of a recognized University or Institute./ A.I.I.I./ F.I.I.I./ C.A./I.C.W.A /Post Graduate Diploma in Insurance from IIRM;</span></td></tr><tr><td class="fr-thick " style="width: 4.8157%; text-align: center; background-color: rgb(209, 72, 65);">3</td><td class="fr-thick " style="width: 17.847%; background-color: rgb(209, 72, 65);">Marine Hull</td><td class="fr-thick " style="width: 77.1483%; background-color: rgb(209, 72, 65);">B.E./ B.Tech./ B.Sc. (Engg.)/ A.M.I.E. or its equivalent thereof (Marine Engineering/ Naval Architecture)/ certificate of competency as Master of Ship or as First Class Marine Engineer issued by a recognized authority,</td></tr><tr><td class="fr-thick " style="width: 4.8157%; text-align: center; background-color: rgb(209, 72, 65);">4</td><td class="fr-thick " style="width: 17.847%; background-color: rgb(209, 72, 65);">Engg.</td><td class="fr-thick fr-highlighted " style="width: 77.1483%; background-color: rgb(209, 72, 65);">B.E./ B.Tech./ B.Sc. (Engg.)/ A.M.I.E. or its equivalent , Diploma of 3 years duration from a recognised institution or its equivalent thereof</td></tr><tr><td class="fr-thick " style="width: 4.8157%; text-align: center; background-color: rgb(209, 72, 65);">5</td><td class="fr-thick " style="width: 17.847%; background-color: rgb(209, 72, 65);">Motor</td><td class="fr-thick " style="width: 77.1483%; background-color: rgb(209, 72, 65);">B.E./ B.Tech./ B.Sc. (Engg.)/ A.M.I.E. or its equivalent thereof (Mechanical/ Automobile); Diploma in Mechanical Engineering/ Automobile Engineering of 3 years duration from a recognised institution or its equivalent thereof ;</td></tr><tr><td class="fr-thick " style="width: 4.8157%; text-align: center; background-color: rgb(209, 72, 65);">6</td><td class="fr-thick " style="width: 17.847%; background-color: rgb(209, 72, 65);">Miscellaneous</td><td class="fr-thick " style="width: 77.1483%; background-color: rgb(209, 72, 65);">B.E./ B.Tech./ B.Sc. (Engg.)/ A.M.I.E. or its equivalent; Diploma of 3 years duration from a recognised institution or its equivalent; C.A./ I.C.W.A.; A.I.I.I./ F.I.I.I./ Post Graduate Diploma in Insurance from IIRM;</td></tr><tr><td class="fr-thick " style="width: 4.8157%; text-align: center; background-color: rgb(209, 72, 65);">7</td><td class="fr-thick  fr-highlighted " style="width: 17.847%; background-color: rgb(209, 72, 65); vertical-align: middle;">LOP</td><td class="fr-thick " style="width: 77.1483%; background-color: rgb(209, 72, 65);">C.A./ I.C.W.A; A.I.I.I./ F.I.I.I</td></tr><tr><td class="fr-thick " style="width: 4.8157%; text-align: center; background-color: rgb(209, 72, 65);">8</td><td class="fr-thick " style="width: 17.847%; background-color: rgb(209, 72, 65);">Crop Insurance</td><td class="fr-thick" style="width: 77.1483%; background-color: rgb(209, 72, 65);">B. Sc. in Agricultural Science from a recognised University</td></tr></tbody></table><p><br></p><p><strong>Note:</strong></p><ol><li>In order to qualify for enrolment and licensing, an applicant should have secured a degree or diploma of a recognized Institute after attending full time course as a regular student or part time course with equivalency certificate issued by the respective Institute/University. Provided in case of courses viz. A.M.I.E; C.A./ I.C.W.A and A.I.I.I./F.I.I.I., course completion certificate is treated as valid qualification.</li><li>All technical Degree/Diploma stated above shall be obtained from</li></ol><ul><li style="margin-left: 40px;">AICTE approved Institutions or</li><li style="margin-left: 40px;">Universities recognized by University Grants Commission or</li><li style="margin-left: 40px;">institutions of national importance recognized by Ministry of Human Resources Development (MHRD)</li></ul><p>G. Reg. 21(4) shall be amended as under:</p>', '2017-06-29 23:50:09');

-- --------------------------------------------------------

--
-- Table structure for table `mocktest`
--

CREATE TABLE `mocktest` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `question` text NOT NULL,
  `option_1` text NOT NULL,
  `option_2` text NOT NULL,
  `option_3` text NOT NULL,
  `option_4` text NOT NULL,
  `answer` text NOT NULL,
  `timeStamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mocktest`
--

INSERT INTO `mocktest` (`id`, `name`, `question`, `option_1`, `option_2`, `option_3`, `option_4`, `answer`, `timeStamp`) VALUES
(1, 'MockTest 1', 'Which of the following statements about medical underwriting is incorrect?', 'True', 'False', '', '', 'False', '2017-07-16 01:27:57'),
(2, 'MockTest 1', 'Who among the following is considered as primary stakeholder in insurance claim process?', 'Customers', 'Owners', 'Underwriters', 'Insurance agents/brokers', 'Owners', '2017-07-16 01:27:57'),
(3, 'MockTest 1', 'Which of the following statements about medical underwriting is incorrect?', 'Current health status and age are the key factors in medical underwriting for health insurance.', 'Proposers have to undergo medical and pathological investigations to assess their health risk profile.', 'Percentage assessment is made on each component of the risk.', 'It involves high cost in collecting and assessing medical reports.', 'Proposers have to undergo medical and pathological investigations to assess their health risk profile.', '2017-07-16 01:28:16'),
(4, 'MockTest 1', 'Who among the following is considered as primary stakeholder in insurance claim process?', 'Customers', 'Owners', 'Underwriters', 'Insurance agents/brokers', 'Underwriters', '2017-07-16 01:28:16'),
(5, 'MockTest 2', 'Which of the following statements about medical underwriting is incorrect?', 'Current health status and age are the key factors in medical underwriting for health insurance.', 'Proposers have to undergo medical and pathological investigations to assess their health risk profile.', 'Percentage assessment is made on each component of the risk.', 'It involves high cost in collecting and assessing medical reports.', 'It involves high cost in collecting and assessing medical reports.', '2017-07-16 01:28:25'),
(6, 'MockTest 2', 'Who among the following is considered as primary stakeholder in insurance claim process?', 'Customers', 'Owners', 'Underwriters', 'Insurance agents/brokers', 'Insurance agents/brokers', '2017-07-16 01:28:25'),
(7, 'MockTest 2', 'Which of the following statements about medical underwriting is incorrect?', 'Current health status and age are the key factors in medical underwriting for health insurance.', 'Proposers have to undergo medical and pathological investigations to assess their health risk profile.', 'Percentage assessment is made on each component of the risk.', 'It involves high cost in collecting and assessing medical reports.', 'Current health status and age are the key factors in medical underwriting for health insurance.', '2017-07-16 01:28:29'),
(8, 'MockTest 3', 'Who among the following is considered as primary stakeholder in insurance claim process?', 'Customers', 'Owners', 'Underwriters', 'Insurance agents/brokers', 'Owners', '2017-07-16 01:28:29'),
(9, 'MockTest 3', 'Which of the following statements about medical underwriting is incorrect?', 'Current health status and age are the key factors in medical underwriting for health insurance.', 'Proposers have to undergo medical and pathological investigations to assess their health risk profile.', 'Percentage assessment is made on each component of the risk.', 'It involves high cost in collecting and assessing medical reports.', 'It involves high cost in collecting and assessing medical reports.', '2017-07-16 01:28:33'),
(10, 'MockTest 3', 'Who among the following is considered as primary stakeholder in insurance claim process?', 'Customers', 'Owners', 'option 3', 'Insurance agents/brokers', 'option 3', '2017-07-16 01:28:33'),
(51, 'Mocktest 4', 'Which of the following statements about medical underwriting is incorrect?', 'It involves high cost in collecting and assessing medical reports.', 'Current health status and age are the key factors in medical underwriting for health insurance.', ' Proposers have to undergo medical and pathological investigations to assess their health risk profile.', 'Percentage assessment is made on each component of the risk.', 'Current health status and age are the key factors in medical underwriting for health insurance.', '2017-07-16 03:58:09'),
(52, 'Mocktest 4', 'Which of the following statements about medical underwriting is incorrect?', 'It involves high cost in collecting and assessing medical reports.', 'Current health status and age are the key factors in medical underwriting for health insurance.', ' Proposers have to undergo medical and pathological investigations to assess their health risk profile.', 'Percentage assessment is made on each component of the risk.', 'Current health status and age are the key factors in medical underwriting for health insurance.', '2017-07-16 03:58:09'),
(53, 'Mocktest 4', 'Which of the following statements about medical underwriting is incorrect?', 'It involves high cost in collecting and assessing medical reports.', 'Current health status and age are the key factors in medical underwriting for health insurance.', ' Proposers have to undergo medical and pathological investigations to assess their health risk profile.', 'Percentage assessment is made on each component of the risk.', 'Current health status and age are the key factors in medical underwriting for health insurance.', '2017-07-16 03:58:09'),
(54, 'Mocktest 4', 'Which of the following statements about medical underwriting is incorrect?', 'It involves high cost in collecting and assessing medical reports.', 'Current health status and age are the key factors in medical underwriting for health insurance.', ' Proposers have to undergo medical and pathological investigations to assess their health risk profile.', 'Percentage assessment is made on each component of the risk.', 'Current health status and age are the key factors in medical underwriting for health insurance.', '2017-07-16 03:58:09'),
(55, 'Mocktest 4', 'Which of the following statements about medical underwriting is incorrect?', 'It involves high cost in collecting and assessing medical reports.', 'Current health status and age are the key factors in medical underwriting for health insurance.', ' Proposers have to undergo medical and pathological investigations to assess their health risk profile.', 'Percentage assessment is made on each component of the risk.', 'Current health status and age are the key factors in medical underwriting for health insurance.', '2017-07-16 03:58:09'),
(56, 'Mocktest 4', 'Which of the following statements about medical underwriting is incorrect?', 'It involves high cost in collecting and assessing medical reports.', 'Current health status and age are the key factors in medical underwriting for health insurance.', 'Proposers have to undergo medical and pathological investigations to assess their health risk profile.', 'Percentage assessment is made on each component of the risk.', 'Proposers have to undergo medical and pathological investigations to assess their health risk profile.', '2017-07-16 03:58:09'),
(57, 'Mocktest 4', 'Which of the following statements about medical underwriting is incorrect?', 'It involves high cost in collecting and assessing medical reports.', 'Current health status and age are the key factors in medical underwriting for health insurance.', ' Proposers have to undergo medical and pathological investigations to assess their health risk profile.', 'Percentage assessment is made on each component of the risk.', 'Current health status and age are the key factors in medical underwriting for health insurance.', '2017-07-16 03:58:09'),
(58, 'Mocktest 4', 'Which of the following statements about medical underwriting is incorrect?', 'It involves high cost in collecting and assessing medical reports.', 'Current health status and age are the key factors in medical underwriting for health insurance.', ' Proposers have to undergo medical and pathological investigations to assess their health risk profile.', 'Percentage assessment is made on each component of the risk.', 'Current health status and age are the key factors in medical underwriting for health insurance.', '2017-07-16 03:58:09'),
(59, 'Mocktest 4', 'Which of the following statements about medical underwriting is incorrect?', 'It involves high cost in collecting and assessing medical reports.', 'Current health status and age are the key factors in medical underwriting for health insurance.', ' Proposers have to undergo medical and pathological investigations to assess their health risk profile.', 'Percentage assessment is made on each component of the risk.', 'Current health status and age are the key factors in medical underwriting for health insurance.', '2017-07-16 03:58:09'),
(60, 'Mocktest 4', 'Which of the following statements about medical underwriting is incorrect?', 'It involves high cost in collecting and assessing medical reports.', 'Current health status and age are the key factors in medical underwriting for health insurance.', ' Proposers have to undergo medical and pathological investigations to assess their health risk profile.', 'Percentage assessment is made on each component of the risk.', 'Current health status and age are the key factors in medical underwriting for health insurance.', '2017-07-16 03:58:09'),
(61, 'Mocktest 4', 'Which of the following statements about medical underwriting is incorrect?', 'It involves high cost in collecting and assessing medical reports.', 'Current health status and age are the key factors in medical underwriting for health insurance.', ' Proposers have to undergo medical and pathological investigations to assess their health risk profile.', 'Percentage assessment is made on each component of the risk.', 'Current health status and age are the key factors in medical underwriting for health insurance.', '2017-07-16 03:58:09'),
(62, 'Mocktest 4', 'Which of the following statements about medical underwriting is incorrect?', 'It involves high cost in collecting and assessing medical reports.', 'Current health status and age are the key factors in medical underwriting for health insurance.', ' Proposers have to undergo medical and pathological investigations to assess their health risk profile.', 'Percentage assessment is made on each component of the risk.', 'Current health status and age are the key factors in medical underwriting for health insurance.', '2017-07-16 03:58:09'),
(63, 'Mocktest 4', 'Which of the following statements about medical underwriting is incorrect?', 'It involves high cost in collecting and assessing medical reports.', 'Current health status and age are the key factors in medical underwriting for health insurance.', ' Proposers have to undergo medical and pathological investigations to assess their health risk profile.', 'Percentage assessment is made on each component of the risk.', 'Current health status and age are the key factors in medical underwriting for health insurance.', '2017-07-16 03:58:09'),
(64, 'Mocktest 4', 'Which of the following statements about medical underwriting is incorrect?', 'It involves high cost in collecting and assessing medical reports.', 'Current health status and age are the key factors in medical underwriting for health insurance.', ' Proposers have to undergo medical and pathological investigations to assess their health risk profile.', 'Percentage assessment is made on each component of the risk.', 'Current health status and age are the key factors in medical underwriting for health insurance.', '2017-07-16 03:58:09'),
(65, 'Mocktest 4', 'Which of the following statements about medical underwriting is incorrect?', 'It involves high cost in collecting and assessing medical reports.', 'Current health status and age are the key factors in medical underwriting for health insurance.', ' Proposers have to undergo medical and pathological investigations to assess their health risk profile.', 'Percentage assessment is made on each component of the risk.', 'Current health status and age are the key factors in medical underwriting for health insurance.', '2017-07-16 03:58:09'),
(66, 'Mocktest 4', 'Which of the following statements about medical underwriting is incorrect?', 'It involves high cost in collecting and assessing medical reports.', 'Current health status and age are the key factors in medical underwriting for health insurance.', ' Proposers have to undergo medical and pathological investigations to assess their health risk profile.', 'Percentage assessment is made on each component of the risk.', 'Current health status and age are the key factors in medical underwriting for health insurance.', '2017-07-16 03:58:09'),
(67, 'Mocktest 4', 'Which of the following statements about medical underwriting is incorrect?', 'It involves high cost in collecting and assessing medical reports.', 'Current health status and age are the key factors in medical underwriting for health insurance.', ' Proposers have to undergo medical and pathological investigations to assess their health risk profile.', 'Percentage assessment is made on each component of the risk.', 'Current health status and age are the key factors in medical underwriting for health insurance.', '2017-07-16 03:58:09'),
(68, 'Mocktest 4', 'Which of the following statements about medical underwriting is incorrect?', 'It involves high cost in collecting and assessing medical reports.', 'Current health status and age are the key factors in medical underwriting for health insurance.', ' Proposers have to undergo medical and pathological investigations to assess their health risk profile.', 'Percentage assessment is made on each component of the risk.', 'Current health status and age are the key factors in medical underwriting for health insurance.', '2017-07-16 03:58:09'),
(69, 'Mocktest 4', 'Which of the following statements about medical underwriting is incorrect?', 'It involves high cost in collecting and assessing medical reports.', 'Current health status and age are the key factors in medical underwriting for health insurance.', ' Proposers have to undergo medical and pathological investigations to assess their health risk profile.', 'Percentage assessment is made on each component of the risk.', 'Current health status and age are the key factors in medical underwriting for health insurance.', '2017-07-16 03:58:09'),
(70, 'Mocktest 4', 'Which of the following statements about medical underwriting is incorrect?', 'It involves high cost in collecting and assessing medical reports.', 'Current health status and age are the key factors in medical underwriting for health insurance.', ' Proposers have to undergo medical and pathological investigations to assess their health risk profile.', 'Percentage assessment is made on each component of the risk.', 'Current health status and age are the key factors in medical underwriting for health insurance.', '2017-07-16 03:58:09'),
(71, 'Mocktest 4', 'Which of the following statements about medical underwriting is incorrect?', 'It involves high cost in collecting and assessing medical reports.', 'Current health status and age are the key factors in medical underwriting for health insurance.', ' Proposers have to undergo medical and pathological investigations to assess their health risk profile.', 'Percentage assessment is made on each component of the risk.', 'Current health status and age are the key factors in medical underwriting for health insurance.', '2017-07-16 03:58:09'),
(72, 'Mocktest 4', 'Which of the following statements about medical underwriting is incorrect?', 'It involves high cost in collecting and assessing medical reports.', 'Current health status and age are the key factors in medical underwriting for health insurance.', ' Proposers have to undergo medical and pathological investigations to assess their health risk profile.', 'Percentage assessment is made on each component of the risk.', 'Current health status and age are the key factors in medical underwriting for health insurance.', '2017-07-16 03:58:09');

-- --------------------------------------------------------

--
-- Table structure for table `slide`
--

CREATE TABLE `slide` (
  `slideID` int(11) NOT NULL,
  `chepterID` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `sequence` int(11) NOT NULL,
  `content` text NOT NULL,
  `timeStamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slide`
--

INSERT INTO `slide` (`slideID`, `chepterID`, `title`, `sequence`, `content`, `timeStamp`) VALUES
(1, 1, 'Financial Activity Slide', 1, '<p><span style="font-size: 36px;"><img src="http://localhost/uploads/images/slides/iioi.jpg" class="fr-fic fr-fil fr-dii fr-rounded fr-bordered">Dating from <span style="color: rgb(26, 188, 156);">1863, <strong>Lorum Old Rectory</strong> sits beneath Moun</span>t Leinster in the peaceful valley of the River Barrow. Its warm, yellowish, locally cut granite gives it a <span style="color: rgb(184, 49, 47);">distinctive and pleasing appearance. The owner, B</span><span style="color: rgb(41, 105, 176);">obbie Smith, is an enthusiastic hostess, fa</span><span style="color: rgb(184, 49, 47);">mous for her warm welcome and splendid home baking. She grew up at Lorum, knows the area intimately and is always a fund of local knowledge. Bobbie also uses Lorum as a base for relaxed, bespoke cycling tours in the neighbouring counties of Carlow, Wexford</span> and Kilkenny. Visitors cycle from house to house and their luggage awaits them on arrival.</span></p><h2><span style="font-size: 36px;">Country<span style="color: rgb(243, 121, 52);"><strong>house</strong> accommodation&nbsp;</span></span></h2><p><span style="font-size: 36px;">Lorum Old Rectory was built from crisp, mellow, locally-cut County Carlow granite which gives the house a feeling of tremendous warmth. The house sits peacefully on the slopes above the River Barrow at Kilgreaney, about half way between Bagenalstown and Borris. Behind the house are Mount Leinster and the Blackstairs Mountains while in front, across the river, are the plains of Kilkenny. Beyond the plains Slievenamon, the Mountain of the Women, in far away Tipperary is clearly visible on fine days.</span></p><p><span style="font-size: 36px;">In the second half of the 20th century the Church of Ireland passed thorough a period of rationalisation. Parishes were amalgamated; churches closed and a number of rectories became redundant and were sold. Among these was Lorum Old Rectory which Mr. Young purchased as a home for his family. Fast forward for another thirty-five years and his daughter Bobbie, on inheriting the house, was forced to make it pay and, together with her late husband Don, decided to provide country house accommodation for visitors to the region.</span></p><h2><span style="font-size: 36px;">Euro-Toques cusine</span></h2><p><span style="font-size: 36px;">They quickly built up an enviable reputation as a well-run, comfortable house o<a href="http://google.com/" rel="noopener noreferrer" target="_blank"><img src="http://localhost/uploads/images/slides/157_Icons_actual_size_white_Research.jpg" style="width: 300px;" class="fr-fic fr-dii fr-rounded"></a>ffering good food and good company. Bobbie, who is a member of Euro-Toques, is renowned as a consummate and considerate hostess, and for her imaginative home cooking, using home-grown or local organic produce wherever possible.</span></p><p><span style="font-size: 36px;">County Carlow is one of Ireland&rsquo;s smallest counties, and Lorum Old Rectory is well positioned for those also who wish to explore the neighbouring counties of Kilkenny, Kildare, Wexford and Wicklow, where there is plenty to see and do.</span></p><h2><span style="font-size: 36px;"><em>Celtic Carlow, Ireland&rsquo;s heritage</em></span></h2><p><span style="font-size: 36px;"><em>For those who want to explore there is a portal dolmen at Brown&rsquo;s Hill and important monastic sites at Ullard and St. Mullins. In the middle of the town of <strong>Graiguenamanagh&nbsp;</strong>is he great Cistercian abbey of Duiske, the largest in Ireland, with the smaller but more beautiful Jerpoint just south of <strong>Thomastown</strong>. The mediaeval town of <strong>Kilkenny&nbsp;</strong>with its castle and museums is worth a visit and nearby gardens include Altamont, Kilfane and Woodstock. There are golf courses at Mount Juliet, Mount Wolsley and Borris, fly fishing for trout and the occasional salmon, and wonderful restful walks along the tow-path of the Barrow Canal or, for the more energetic, in the Blackstairs Mountains.</em></span></p><p><em><span style="font-size: 36px;">Lorum Old Rectory Guest House Bagnelstown, is also home to Celtic Cycling, which runs bespoke cycling tours for couples and small groups throughout the South East, along the Rivers Barrow and Nore, through unspoilt countryside with pretty villages and small hamlets. And, for those who prefer to do nothing, the garden and croquet lawn at Lorum Old Rectory are delightfully peaceful and relaxing.</span></em></p>', '2017-06-03 11:29:53'),
(6, 3, 'zxcxcgg', 5, '<p>sdgz fg dfgxdf gdxfg</p>', '2017-07-02 01:58:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accreditation`
--
ALTER TABLE `accreditation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assessment`
--
ALTER TABLE `assessment`
  ADD PRIMARY KEY (`assessmentID`);

--
-- Indexes for table `assessmentattempt`
--
ALTER TABLE `assessmentattempt`
  ADD PRIMARY KEY (`assessmentattemptID`);

--
-- Indexes for table `assessmentquestion`
--
ALTER TABLE `assessmentquestion`
  ADD PRIMARY KEY (`assessmentQuestionID`);

--
-- Indexes for table `chepter`
--
ALTER TABLE `chepter`
  ADD PRIMARY KEY (`chepterID`);

--
-- Indexes for table `chepterquestion`
--
ALTER TABLE `chepterquestion`
  ADD PRIMARY KEY (`chepterquestionID`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`companyID`);

--
-- Indexes for table `companycourse`
--
ALTER TABLE `companycourse`
  ADD PRIMARY KEY (`companycourseID`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`courseID`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`departmentID`);

--
-- Indexes for table `documentation`
--
ALTER TABLE `documentation`
  ADD PRIMARY KEY (`documentationID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employeeID`);

--
-- Indexes for table `employeeassessment`
--
ALTER TABLE `employeeassessment`
  ADD PRIMARY KEY (`employeeassessmentID`);

--
-- Indexes for table `employeecourse`
--
ALTER TABLE `employeecourse`
  ADD PRIMARY KEY (`employeecourseID`);

--
-- Indexes for table `enquiry`
--
ALTER TABLE `enquiry`
  ADD PRIMARY KEY (`enquiryID`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`faqID`);

--
-- Indexes for table `forgotpassword`
--
ALTER TABLE `forgotpassword`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `glossary`
--
ALTER TABLE `glossary`
  ADD PRIMARY KEY (`glossaryID`);

--
-- Indexes for table `guidline`
--
ALTER TABLE `guidline`
  ADD PRIMARY KEY (`guidlineID`);

--
-- Indexes for table `mocktest`
--
ALTER TABLE `mocktest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slide`
--
ALTER TABLE `slide`
  ADD PRIMARY KEY (`slideID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accreditation`
--
ALTER TABLE `accreditation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `assessment`
--
ALTER TABLE `assessment`
  MODIFY `assessmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `assessmentattempt`
--
ALTER TABLE `assessmentattempt`
  MODIFY `assessmentattemptID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `assessmentquestion`
--
ALTER TABLE `assessmentquestion`
  MODIFY `assessmentQuestionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=541;
--
-- AUTO_INCREMENT for table `chepter`
--
ALTER TABLE `chepter`
  MODIFY `chepterID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `chepterquestion`
--
ALTER TABLE `chepterquestion`
  MODIFY `chepterquestionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `companyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `companycourse`
--
ALTER TABLE `companycourse`
  MODIFY `companycourseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `courseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `departmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `documentation`
--
ALTER TABLE `documentation`
  MODIFY `documentationID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employeeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
--
-- AUTO_INCREMENT for table `employeeassessment`
--
ALTER TABLE `employeeassessment`
  MODIFY `employeeassessmentID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `employeecourse`
--
ALTER TABLE `employeecourse`
  MODIFY `employeecourseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `enquiry`
--
ALTER TABLE `enquiry`
  MODIFY `enquiryID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `faqID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `forgotpassword`
--
ALTER TABLE `forgotpassword`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `glossary`
--
ALTER TABLE `glossary`
  MODIFY `glossaryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `guidline`
--
ALTER TABLE `guidline`
  MODIFY `guidlineID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `mocktest`
--
ALTER TABLE `mocktest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT for table `slide`
--
ALTER TABLE `slide`
  MODIFY `slideID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
