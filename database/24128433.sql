SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- Database: `24128443`

-- Table structure for table `anime`
DROP TABLE IF EXISTS `anime`;
CREATE TABLE IF NOT EXISTS `anime` (
  `animeID` int(11) NOT NULL AUTO_INCREMENT,
  `animeTitle` varchar(255) NOT NULL,
  `animeSinopse` text,
  `animeAvatar` varchar(255),
  `animeBanner` varchar(255),
  `animeType` varchar(50),
  `animeEpisodes` int(11),
  `animeStatus` varchar(50),
  `animeStart` date,
  `animeEnd` date,
  `animeSource` varchar(50),
  `animeGenres` varchar(255),
  PRIMARY KEY (`animeID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- Dumping data for table `anime`
INSERT INTO `anime` (`animeID`, `animeTitle`, `animeSinopse`, `animeAvatar`, `animeBanner`, `animeType`, `animeEpisodes`, `animeStatus`, `animeStart`, `animeEnd`, `animeSource`, `animeGenres`) VALUES
(1, 'Steins;Gate', 'The self-proclaimed mad scientist Rintarou Okabe rents out a room in a rickety old building in Akihabara, where he indulges himself in his hobby of inventing potential \"future gadgets\" with fellow lab members: Mayuri Shiina, his air-headed childhood friend, and Hashida Itaru, a perverted hacker nicknamed \"Daru.\" The three pass the time by tinkering with a machine called the \"Phone Microwave,\" which performs the strange function of turning bananas into piles of green gel.<br><br>\r\n\r\nThough miraculous in itself, the phenomenon doesn\'t provide anything concrete in Okabe\'s search for a scientific breakthrough; that is, until the lab members are spurred into action by a string of mysterious happenings before stumbling upon an unexpected success—the Phone Microwave can send emails to the past, altering the flow of history.<br><br>\r\n\r\nAdapted from the critically acclaimed visual novel by 5pb. and Nitroplus, Steins;Gate takes Okabe through the depths of scientific theory and practicality. Forced across the diverging threads of past and present, Okabe must shoulder the burdens that come with holding the key to the realm of time.', '1.jpg', '1.jpg', 'TV', 24, 'Finished', '2011-04-06', '2011-09-14', 'Novel', 'Science Fiction, Thriller'),
(2, 'Bakemonogatari', 'Koyomi Araragi, a third-year high school student, manages to survive a vampire attack with the help of Meme Oshino, a strange man residing in an abandoned building. Though being saved from vampirism and now a human again, several side effects such as superhuman healing abilities and enhanced vision still remain. Regardless, Araragi tries to live the life of a normal student, with the help of his friend and the class president, Tsubasa Hanekawa.<br><br>\r\n\r\nWhen fellow classmate Hitagi Senjougahara falls down the stairs and is caught by Araragi, the boy realizes that the girl is unnaturally weightless. Despite Senjougahara\'s protests, Araragi insists on helping her, deciding to enlist the assistance of Oshino, the very man who once helped him with his own predicament.<br><br>\r\n\r\nThrough several tales involving demons and gods, Bakemonogatari follows Araragi as he attempts to help those who suffer from supernatural maladies.', '2.jpg', '2.jpg', 'TV', 15, 'Finished', '2009-07-03', '2010-06-25', 'Novel', 'Mystery, Romance, Supernatural, Vampire'),
(3, 'Re:Zero kara Hajimeru Isekai Seikatsu', 'When Subaru Natsuki leaves the convenience store, the last thing he expects is to be wrenched from his everyday life and dropped into a fantasy world. Things aren\'t looking good for the bewildered teenager; however, not long after his arrival, he is attacked by some thugs. Armed with only a bag of groceries and a now useless cell phone, he is quickly beaten to a pulp. Fortunately, a mysterious beauty named Satella, in pursuit of the one who stole her insignia, happens upon Subaru and saves him. In order to thank the honest and kindhearted girl, Subaru offers to help in her search, and later that night, he even finds the whereabouts of that which she seeks. But unbeknownst to them, a much darker force stalks the pair from the shadows, and just minutes after locating the insignia, Subaru and Satella are brutally murdered.<br><br>\r\n\r\nHowever, Subaru immediately awakens to a familiar scene—confronted by the same group of thugs, meeting Satella all over again—the enigma deepens as history inexplicably repeats itself.', '3.jpg', '3.jpg', 'TV', 25, 'Finished', '2016-04-04', '2016-09-19', 'Novel', 'Drama, Fantasy, Psychological, Thriller '),
(4, 'Code Geass: Hangyaku no Lelouch', 'In the year 2010, the Holy Empire of Britannia is establishing itself as a dominant military nation, starting with the conquest of Japan. Renamed Area 11 after its swift defeat, Japan has seen significant resistance against these tyrants in an attempt to regain independence.<br><br>\r\n\r\nLelouch Lamperouge, a Britannian student, unfortunately finds himself caught in a crossfire between the Britannian and the Area 11 rebel armed forces. He is able to escape, however, thanks to the timely appearance of a mysterious girl named C.C., who bestows upon him Geass, the \"Power of Kings.\" Realizing the vast potential of his newfound \"power of absolute obedience,\" Lelouch embarks on a perilous journey as the masked vigilante known as Zero, leading a merciless onslaught against Britannia in order to get revenge once and for all.', '4.jpg', '4.jpg', 'TV', 25, 'Finished', '2006-10-06', '2007-07-29', NULL, 'Action, Military, Science Fiction, Super Power, Drama, Mecha, School'),
(5, 'Death Note', 'A shinigami, as a god of death, can kill any person—provided they see their victim\'s face and write their victim\'s name in a notebook called a Death Note. One day, Ryuk, bored by the shinigami lifestyle and interested in seeing how a human would use a Death Note, drops one into the human realm.<br><br>\r\n\r\nHigh school student and prodigy Light Yagami stumbles upon the Death Note and—since he deplores the state of the world—tests the deadly notebook by writing a criminal\'s name in it. When the criminal dies immediately following his experiment with the Death Note, Light is greatly surprised and quickly recognizes how devastating the power that has fallen into his hands could be.<br><br>\r\n\r\nWith this divine capability, Light decides to extinguish all criminals in order to build a new world where crime does not exist and people worship him as a god. Police, however, quickly discover that a serial killer is targeting criminals and, consequently, try to apprehend the culprit. To do this, the Japanese investigators count on the assistance of the best detective in the world: a young and eccentric man known only by the name of L.', '5.jpg', '5.jpg', 'TV', 37, 'Finished', '2006-10-04', '2007-06-27', NULL, 'Mystery, Police, Psychological, Supernatural, Thriller, Shounen'),
(6, 'Yahari Ore no Seishun Love Comedy wa Machigatteiru', 'Hachiman Hikigaya is an apathetic high school student with narcissistic and semi-nihilistic tendencies. He firmly believes that joyful youth is nothing but a farce, and everyone who says otherwise is just lying to themselves.<br><br>\r\n\r\nIn a novel punishment for writing an essay mocking modern social relationships, Hachiman\'s teacher forces him to join the Volunteer Service Club, a club that aims to extend a helping hand to any student who seeks support in achieving their goals. With the only other club member being the beautiful ice queen Yukino Yukinoshita, Hachiman finds himself on the front line of other people\'s problems—a place he never dreamed he would be. As Hachiman and Yukino use their wits to solve many students\' problems, will Hachiman\'s rotten view of society prove to be a hindrance or a tool he can use to his advantage?\r\n', '6.jpg', '6.jpg', 'TV', 13, 'Finished', '2013-04-05', '2013-06-28', 'Novel', 'Slice of Life, Comedy, Drama, Romance, School'),
(7, 'Shingeki no Kyojin', 'Centuries ago, mankind was slaughtered to near extinction by monstrous humanoid creatures called titans, forcing humans to hide in fear behind enormous concentric walls. What makes these giants truly terrifying is that their taste for human flesh is not born out of hunger but what appears to be out of pleasure. To ensure their survival, the remnants of humanity began living within defensive barriers, resulting in one hundred years without a single titan encounter. However, that fragile calm is soon shattered when a colossal titan manages to breach the supposedly impregnable outer wall, reigniting the fight for survival against the man-eating abominations.<br><br>\r\n\r\nAfter witnessing a horrific personal loss at the hands of the invading creatures, Eren Yeager dedicates his life to their eradication by enlisting into the Survey Corps, an elite military unit that combats the merciless humanoids outside the protection of the walls. Based on Hajime Isayama\'s award-winning manga, Shingeki no Kyojin follows Eren, along with his adopted sister Mikasa Ackerman and his childhood friend Armin Arlert, as they join the brutal war against the titans and race to discover a way of defeating them before the last walls are breached.\r\n', '7.jpg', '7.jpg', 'TV', 25, 'Finished', '2013-04-07', '2013-09-29', 'Manga', 'Action, Military, Mystery, Super Power, Drama, Fantasy, Shounen'),
(8, 'Hunter x Hunter (2011)', 'Hunter x Hunter is set in a world where Hunters exist to perform all manner of dangerous tasks like capturing criminals and bravely searching for lost treasures in uncharted territories. Twelve-year-old Gon Freecss is determined to become the best Hunter possible in hopes of finding his father, who was a Hunter himself and had long ago abandoned his young son. However, Gon soon realizes the path to achieving his goals is far more challenging than he could have ever imagined.<br><br>\r\n\r\nOn the way to becoming an official Hunter, Gon befriends the lively doctor-in-training Leorio, vengeful Kurapika, and rebellious ex-assassin Killua. To attain their own goals and desires, together the four of them take the Hunter Exam, notorious for its low success rate and high probability of death. Throughout their journey, Gon and his friends embark on an adventure that puts them through many hardships and struggles. They will meet a plethora of monsters, creatures, and characters—all while learning what being a Hunter truly means.', '8.jpg', '8.jpg', 'TV', 148, 'Finished', '2011-10-02', '2014-09-24', 'Manga', 'Action, Adventure, Fantasy, Shounen, Super Power'),
(9, 'Fullmetal Alchemist: Brotherhood', '\"In order for something to be obtained, something of equal value must be lost.\"<br><br>\r\n\r\nAlchemy is bound by this Law of Equivalent Exchange—something the young brothers Edward and Alphonse Elric only realize after attempting human transmutation: the one forbidden act of alchemy. They pay a terrible price for their transgression—Edward loses his left leg, Alphonse his physical body. It is only by the desperate sacrifice of Edward\'s right arm that he is able to affix Alphonse\'s soul to a suit of armor. Devastated and alone, it is the hope that they would both eventually return to their original bodies that gives Edward the inspiration to obtain metal limbs called \"automail\" and become a state alchemist, the Fullmetal Alchemist.<br><br>\r\n\r\nThree years later, the brothers seek the Philosopher\'s Stone, a mythical relic that allows an alchemist to overcome the Law of Equivalent Exchange. Even with military allies Colonel Roy Mustang, Lieutenant Riza Hawkeye, and Lieutenant Colonel Maes Hughes on their side, the brothers find themselves caught up in a nationwide conspiracy that leads them not only to the true nature of the elusive Philosopher\'s Stone, but their country\'s murky history as well. In between finding a serial killer and racing against time, Edward and Alphonse must ask themselves if what they are doing will make them human again... or take away their humanity.', '9.jpg', '9.jpg', 'TV', 64, 'Finished', '2009-04-05', '2010-07-04', 'Manga', 'Action, Military, Adventure, Comedy, Drama, Magic, Fantasy, Shounen'),
(10, 'Youkoso Jitsuryoku Shijou Shugi no Kyoushitsu e', 'On the surface, Koudo Ikusei Senior High School is a utopia. The students enjoy an unparalleled amount of freedom, and it is ranked highly in Japan. However, the reality is less than ideal. Four classes, A through D, are ranked in order of merit, and only the top classes receive favorable treatment.<br><br>\r\n\r\nKiyotaka Ayanokouji is a student of Class D, where the school dumps its worst. There, he meets the unsociable Suzune Horikita, who believes she was placed in Class D by mistake and desires to climb all the way to Class A, and the seemingly amicable class idol Kikyou Kushida, whose aim is to make as many friends as possible.<br><br>\r\n\r\nWhile class membership is permanent, class rankings are not; students in lower ranked classes can rise in rankings if they score better than those in the top ones. Additionally, in Class D, there are no restrictions on what methods can be used to get ahead. In this cutthroat school, can they prevail against the odds and reach the top?', '10.jpg', '10.jpg', 'TV', 12, 'Finished', '2017-07-12', '2017-09-27', 'Novel', 'Slice of Life, Psychological, Drama, School	'),
(11, 'Toradora!', NULL, '11.jpg', NULL, 'TV', NULL, 'Finished', NULL, NULL, NULL, NULL),
(12, 'Naruto', NULL, '12.jpg', NULL, 'TV', NULL, 'Finished', NULL, NULL, NULL, NULL),
(13, 'Neon Genesis Evangelion', NULL, '13.jpg', NULL, 'TV', NULL, 'Finished', NULL, NULL, NULL, NULL),
(14, 'Kono Subarashii Sekai ni Shukufuku wo!', NULL, '14.jpg', NULL, 'TV', NULL, 'Finished', NULL, NULL, NULL, NULL),

-- Table structure for table `anime_characters`
DROP TABLE IF EXISTS `anime_characters`;
CREATE TABLE IF NOT EXISTS `anime_characters` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `animeID` int(11) NOT NULL,
  `characterID` int(11) NOT NULL,
  `characterRole` varchar(50),
  PRIMARY KEY (`ID`),
  KEY `animeID` (`animeID`),
  KEY `characterID` (`characterID`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- Dumping data for table `anime_characters`
INSERT INTO `anime_characters` (`ID`, `animeID`, `characterID`, `characterRole`) VALUES
(1, 1, 1, 'Main'),
(2, 1, 2, 'Main'),
(3, 1, 3, 'Main'),
(4, 1, 4, 'Main'),
(5, 1, 5, 'Supporting'),
(6, 1, 6, 'Supporting'),
(7, 2, 7, 'Main'),
(8, 2, 8, 'Main'),
(9, 2, 9, 'Main'),
(10, 2, 10, 'Main'),
(11, 2, 11, 'Main'),
(12, 2, 12, 'Main'),
(13, 3, 13, 'Main'),
(14, 3, 14, 'Main'),
(15, 3, 15, 'Supporting'),
(16, 3, 16, 'Supporting'),
(17, 3, 17, 'Supporting'),
(18, 3, 18, 'Supporting');

-- Table structure for table `anime_favorites`
DROP TABLE IF EXISTS `anime_favorites`;
CREATE TABLE IF NOT EXISTS `anime_favorites` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `animeID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `animeID` (`animeID`),
  KEY `userID` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Table structure for table `anime_users`
DROP TABLE IF EXISTS `anime_users`;
CREATE TABLE IF NOT EXISTS `anime_users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `animeID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `userStatus` int(1) NOT NULL DEFAULT '1',
  `userScore` int(2) DEFAULT NULL,
  `userEpisodes` int(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `animeID` (`animeID`),
  KEY `userID` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Table structure for table `characters`
DROP TABLE IF EXISTS `characters`;
CREATE TABLE IF NOT EXISTS `characters` (
  `characterID` int(11) NOT NULL AUTO_INCREMENT,
  `characterName` varchar(255) NOT NULL,
  `characterAvatar` varchar(255),
  `characterInfo` text,
  PRIMARY KEY (`characterID`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

-- Dumping data for table `characters`
INSERT INTO `characters` (`characterID`, `characterName`, `characterAvatar`, `characterInfo`) VALUES
(1, 'Rintarou Okabe', '1.jpg', 'Age: 18<br>\r\nBirthdate: December 14<br>\r\nHeight: 177 cm<br>\r\nWeight: 60 kg<br><br>\r\n\r\nOkabe Rintarou is the main protagonist of Steins; Gate. He is a first-year student at Tokyo Denki University and self-proclaims himself as a mad scientist. He acts like a villain but is quite immature, as he often shows traits of the Chunibyou syndrome (中二病), despite being an adult man. After enrolling in university, he went to Akihabara to open a lab called \"Future Gadget\" Research Establishment,\" where he invents gadgets that are quite useless. He also talks to himself on his cell phone, his words not making much sense. Supposedly, he has very few friends who can understand what he is talking about.\r\n<br><br>\r\nOkabe often refers to himself as \"Hououin Kyouma\" (鳳凰院凶真). However, Mayuri and Daru just call him \"Okarin\" (オカリン), abbreviated after his name.<br><Br>\r\n\r\nThe phrase he uses to end conversations, particularly with himself, is \"El Psy Kongroo\" (エル・プサイ・コングルゥ)'),
(2, 'Kurisu Makise', '2.jpg', NULL),
(3, 'Mayuri Shiina', '3.jpg', NULL),
(4, 'Itaru Hashida', '4.jpg', NULL),
(5, 'Suzuha Amane', '5.jpg', NULL),
(6, 'Rumiho Akiha', '6.jpg', NULL),
(7, 'Koyomi Araragi', '7.jpg', NULL),
(8, 'Hitagi Senjougahara', '8.jpg', NULL),
(9, 'Tsubasa Hanekawa', '9.jpg', NULL),
(10, 'Mayoi Hachikuji', '10.jpg', NULL),
(11, 'Suruga Kanbaru', '11.jpg', NULL),
(12, 'Nadeko Sengoku', '12.jpg', NULL),
(13, 'Subaru Natsuki', '13', NULL),
(14, 'Emilia', '14', NULL),
(15, 'Rem', '15', NULL),
(16, 'Ram', '16', NULL),
(17, 'Beatrice', '17', NULL),
(18, 'Pack', '18', NULL),
(19, 'Eikichi Onizuka', '19.jpg', 'Birthday: August 3, 1975<br><br>\r\n\r\nOnizuka Eikichi, a 22-year-old hormonal, blonde-haired, virgin biker, graduated from a low-tier university by cheating and, as such, cannot get a decent job. His main way of passing the time is peeking up girls\' skirts at a local mall. He is very athletic, as he can bench press 150 kg (331 lbs), has a second-degree black belt in karate, and even claims to do 500 push-ups, 1000 sit-ups, and 2000 squats daily. Through the events explained in the Great Teacher Onizuka manga, Onizuka decides to become a teacher, though it is later implied that he has an IQ of around 50 (though not necessarily true).<br><br>\r\n\r\nHis initial teacher training is at Musashino Public Public School, where he meets Nanako Mizuki. His experience of taming the rowdy classes of his assigned class hardens his convictions that teaching is the way to go, and when he finds out Mizuki\'s problems, he also decides to abstain from sexual experiences with his students, opting to solve their personal problems for them instead. Unfortunately, he almost blew it by forgetting to take the public teacher civil service exam. As a result, no public school will take him, but he is still eligible for several private schools. He manages to get a job at the upper-crust Holy Forest Academy, despite the objections of Vice Principal Uchiyamada Hiroshi, whom he continues to aggravate throughout his tenure. Of course, one of the conditions of having a job at Holy Forest is that he must sleep at the school—in the storage room on the top floor, with access to the roof—and it is here that Onizuka officially begins his career as a teacher, when he stops Yoshikawa Noboru from committing suicide. Onizuka is put in charge of class 3-4, a class so bad that it has driven several teachers to madness. He not only survives the class\'s brutal bullying tactics, but also befriends his students, and the backbone of the Great Teacher Onizuka story consists of his unique experiences in transforming his students and learning lessons.<br><br>\r\n\r\nLater it is implied again, during the National Exams, that Onizuka may actually be some kind of genius. His exam results were swapped: one for the top score and one for the bottom score. However, when Yoshito Kikuchi is asked if he is curious about Onizuka\'s true results, he checks the answers and the result surprises him. He checks with Onizuka, who claims that he definitely got perfect results through his own effort (which would be amazing, since he took a 5-hour exam in 1 hour, bleeding and with 4 bullets in his stomach). Onizuka has incredible physical endurance. On more than one occasion, he has fallen from heights that would instantly kill most people and claims to have some kind of healing factor, as he recovered from a broken arm in less than a day and even suffered multiple gunshot wounds, in a short period of time.<br><br>\r\n\r\nHis fighting skills should also not be taken lightly, as Onizuka is able to fend off multiple opponents, even if they are well-armed, and almost never takes any physical damage. Despite his impressive fighting skills, Onizuka is often scolded by his students and others, whenever he misbehaves. One can speculate that, deep down, Onizuka knows when he is acting immature and allows others to keep him in line. An example of this is when he forces his students to dig the ground for buried treasures during the Okinawa trip. Kanzaki Urumi kicks Onizuka into a hole, and later forces him to wear S&M clothes and makes him crawl on all fours, with Urumi walking backwards.<br><br>\r\n\r\nHis personal mode of transportation is a Kawasaki 750 Road Star Z2. The bike itself is also featured in the GTO prequel series.'),
(20, 'Azusa Fuyutsyki', '20.jpg', 'A beautiful 22-year-old teacher who is the heroine of the series. Unlike Onizuka, she led a relatively normal life, graduating from Waseda University. Her quiet manner and moderate ideas are deceptive, as she proves to be very tough on her own, sometimes even scaring Onizuka. To prepare him for the test that would determine his teaching career, she prepares a mountain of jelly with Maguro tuna eyes as fruits and imposes incredibly difficult schedules that would kill someone or drive them insane. Her teaching field is Kokugo or the Japanese language (English in the Live Action). She, not surprisingly, falls in love with Onizuka, but as both are reluctant to admit their feelings and show them openly, they claim to be just \'friends\'. This is not really a major issue for anyone else except Suguru Teshigawara, who finds it more annoying that a woman with her qualifications would fall for someone with as rough a background as Onizuka. She has trouble with the female students in her class due to all the boys in the class having crushes on her, but she quickly brings them around after Onizuka\'s advice. She has a younger sister named Makoto.<br><br>\r\n\r\nThe Azusa Fuyutsuki portrayed in the live-action drama differs greatly from the anime and manga versions. In this version, Fuyutsuki became a teacher because she felt forced to and envies the life of her sister, who became a flight attendant who frequently dates male celebrities (and also receives some extravagant gifts). She ends up deciding to remain as a teacher thanks to some convincing from Onizuka, though the two are continually portrayed as at odds with heavily implied love. The live-action version of Fuyutsuki also detests men in general, finding them too possessive of women, though Onizuka also convinces her that she is guilty of the same sin as well. Interestingly, she is also present in many of the \'lessons\' that Onizuka personally teaches to his students.'),
(21, 'Hiroshi Uchiyamada', '21.jpg', 'The father of Yoshiko and vice-principal of Holy Forest Academy. He is a very strict man who blindly follows the school\'s rules and puts them above anything else. Additionally, he does not have much patience.<br><br>\r\n\r\nHiroshi easily gets irritated by Onizuka\'s behavior basically all the time. He shows that he has no respect for the school delinquents or even rebels against the guys during the series. He believes that Onizuka is the root of all his misfortunes. He was visibly against hiring Onizuka, but had to accept the positive decision of Principal Sakurai. Uchiyamada is always yelling at Onizuka\'s behavior and argues a lot with him.'),
(22, 'Urumi Kanzaki', '22.jpg', 'The antithesis of the \"dumb blonde\" stereotype, Urumi Kanzaki is a prodigy with an IQ above 200. She is also heterochromatic, with differently colored eyes: one brown and one blue. However, she is psychologically disturbed, having her fair share of hatred towards teachers. Her genius is repeatedly displayed by abstract actions like detonating time bombs (i.e., fireworks in disposable boxes) and making a harmless snake look like a cobra using paper cutouts. Her intellect is also shown through actions, such as yelling profanities in French and being able to speak Mandarin fluently. During the Okinawa trip, Toshito Kikuchi noted that she can speak five languages, but ironically, she does not understand what her Gundam otaku roommates are saying.'),
(23, 'Miyabi Aizawa', '23.jpg', 'In the anime, Aizawa began to no longer trust teachers when one of her classmates got involved in a scandal due to an affair with her former instructor. From this, she and her companions began their quest to expel any teacher assigned to their class. They succeeded in making these teachers quit, but Onizuka...'),
(24, 'Yoshito Kikuchi', '24.jpg', 'Yoshito Kikuchi is one of Eikichi Onizuka\'s students. This computer prodigy (who scored the highest in the country without certain \"aids\" on a standardized test) serves as class president and is also known for making composite pornographic pictures, during Onizuka\'s arrival at Holy Forest Academy. He tries to blackmail him into resigning with various pictures posted all over the school for everyone to see. Onizuka catches Kikuchi and, instead of punishing him, hires him to make composite pictures of Azusa Fuyutsuki and other teachers, to his surprise.<br><br>\r\n\r\nKikuchi eventually befriends Onizuka and later helps Noboru Yoshikawa stop Anko Uehara\'s mother, the local PTA president, from being fired. Kikuchi is an amateur martial artist, with prior experience in judo and other techniques learned from Mayu Wakui (in the live-action, he claims to only know him and does not demonstrate this claim). After the exams, it is revealed that he was the one who swapped Onizuka\'s test papers for a perfect score. When asked about Onizuka\'s actual results, Kikuchi calculates it himself and is completely surprised by the score (it is unknown if Onizuka actually got the perfect score or with intelligence) and asks him directly, to which the teacher responds that he definitely got a perfect score.<br><br>\r\n\r\nIn the manga, a possible relationship is suggested between him and Ai Tokiwa, after some intervention and a forced hug from Onizuka. In the live-action, Kikuchi has a long-distance relationship with Tomoko Nomura.'),
(25, 'Kiyotaka Ayanokouji', '25.jpg', 'Birthday: October 20<br>\r\nHeight: 176 cm<br>\r\nZodiac sign: Libra<br>\r\nFavorite place: None<br>\r\nDislikes: Acting by the book<br>\r\nUsual place: his room<br><br>\r\n\r\nAn inconspicuous student who is very poor at communicating with other people, even if he wants to, so he tends to isolate himself. His emotions are hard to read. He received \"perfectly intermediate\" grades on his entrance exam, as academically and athletically, he is average.\r\n'),
(26, 'Suzune Horikita', '26.jpg', 'Birthday: February 15<br>\r\nHeight: 156 cm<br>\r\nZodiac sign: Aquarius<br>\r\nBWH: 79/54/79<br>\r\nLikes: Seriousness and diligence<br>\r\nDislikes: Sweetness<br>\r\nUsual place: her room<br><br>\r\n\r\nA beautiful girl who sits next to Ayanokouji. She is the opposite of Ayanokouji when it comes to friendship; she disregards and thinks making friends unnecessary, therefore she does not communicate much with her classmates. She is not convinced that she was placed in Class D, so she aims to be promoted to Class A.'),
(27, 'Kikyou Kushida', '27.jpg', 'Birthday: January 23<br>\r\nHeight: 155 cm<br>\r\nZodiac sign: Aquarius<br>\r\nBWH: 82/55/83<br>\r\nLikes: Being able to get along with other people, even strangers<br>\r\nDislikes: Whenever people do not get along<br>\r\nUsual place: School, café, Zelkey shopping, dormitory<br><br>\r\n\r\nShe possesses enormous popularity among both men and women as the idol of Class D. She aims to be friends with everyone, not just Class D. She wants to get along with her classmate, Horikita.'),
(28, 'Kei Karuizawa', '28.jpg', 'Birthday: March 8<br>\r\nHeight: 154 cm<br>\r\nZodiac sign: Pisces<br>\r\nBWH: 76/54/77<br>\r\nLikes: Being the central figure of the class<br>\r\nDislikes: Acting by the book<br>\r\nUsual place: café, Zelkey shopping, karaoke<br><br>\r\n\r\nShe is a girl with a bad attitude who is located at the top of Class D\'s hierarchy. She competes with Kushida for the top 2 spots in the class.'),
(29, 'Honami Ichinose', '29.jpg', 'She is a student of Class B and is referred to as the central figure of Class B by Horikita Suzune.'),
(30, 'Arisu Sakayanagi', '30.jpg', 'Age: 16<br>\r\nBirthday: March 12<br>\r\nHeight: 150 cm<br>\r\nMeasurements: B70 / W54 / H77<br><br>\r\n\r\nShe seems to have a \"go with the flow\" attitude, as she accepts most situations without protest, though she expresses her displeasure at boring situations after Katsuragi noticed the class score. Unlike Kouhei Katsuragi, who has a conservative stance, Arisu possesses an innovative attitude. Together, the two effectively lead Class A through the school years.');

-- Table structure for table `characters_favorites`
DROP TABLE IF EXISTS `characters_favorites`;
CREATE TABLE IF NOT EXISTS `characters_favorites` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `characterID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `characterID` (`characterID`),
  KEY `userID` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Table structure for table `manga`
DROP TABLE IF EXISTS `manga`;
CREATE TABLE IF NOT EXISTS `manga` (
  `mangaID` int(11) NOT NULL AUTO_INCREMENT,
  `mangaTitle` varchar(255) NOT NULL,
  `mangaSinopse` text,
  `mangaAvatar` varchar(255),
  `mangaBanner` varchar(255),
  `mangaType` varchar(50),
  `mangaChapters` int(11),
  `mangaVolumes` int(11),
  `mangaStatus` varchar(50),
  `mangaStart` date,
  `mangaEnd` date,
  `mangaGenres` varchar(255),
  PRIMARY KEY (`mangaID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- Dumping data for table `manga`
INSERT INTO `manga` (`mangaID`, `mangaTitle`, `mangaSinopse`, `mangaAvatar`, `mangaBanner`, `mangaType`, `mangaChapters`, `mangaVolumes`, `mangaStatus`, `mangaStart`, `mangaEnd`, `mangaGenres`) VALUES
(1, 'GTO', 'Eikichi Onizuka, age 22: ex-gang member... and teacher?<br><br>\r\n\r\nGreat Teacher Onizuka follows the incredible, though often ridiculous, antics of the titular teacher as he tries to con and conquer the crafty Class 3-4 that is determined to have him removed from the school. However, other obstacles present themselves everywhere—including the frustrated and bald Vice Principal Hiroshi Uchiyamada; old enemies from his biker days; and his own idiotic teaching methods. But Eikichi fights against all this as he tries to help his students, the romance teacher Azusa Fuyutsuki, and earn his self-proclaimed title.', '1.jpg', '1.jpg', 'Manga', 208, 25, 'Finished', '1996-12-11', '2002-01-30', 'Action, Comedy, Drama, Ecchi, School, Shounen'),
(2, 'Youkoso Jitsuryoku Shijou Shugi no Kyoushitsu e', 'Koudo Ikusei Senior High School, a leading prestigious school with state-of-the-art facilities where nearly 100% of students go on to university or find employment. Students are given the freedom to use any hairstyle and bring any personal items they desire. Koudo Ikusei is a paradise-like school, but the truth is that only the top students receive favorable treatment.<br><br>\r\n\r\nProtagonist Kiyotaka Ayanokouji is a student of Class D, which is where the school dumps its \"inferior\" students in order to ridicule them. For a certain reason, Kiyotaka was careless in his entrance exam and was placed in Class D. After meeting Suzune Horikita and Kikyou Kushida, two other students in his class, Kiyotaka\'s situation begins to change.', '2.jpg', '2.jpg', 'Novel', NULL, NULL, 'Publishing', '2015-05-25', NULL, 'Comedy, Romance, School'),
(3, 'Onanie Master Kurosawa', 'Fourteen-year-old Kakeru Kurosawa is an antisocial middle school student who looks down on his classmates—but beneath his superiority complex is a hopeless young teenager who uses masturbation as a pastime. Using erotic thoughts of his female classmates as stimulation, he locks himself daily in a rarely used girls\' bathroom at school to do his dirty deed.<br><br>\r\n\r\nOne day, during class, Kurosawa witnesses the popular girls bullying the shy Aya Kitahara. Though not someone who gets riled up over such matters, he decides to pay them back with his own hands. In a bold move, he steals the bullies\' uniforms and distributes his \"white justice\" over them.<br><br>\r\n\r\nThough satisfied with his exploits, Kurosawa\'s troubles are only beginning. As he goes about his daily routine, he is suddenly confronted by Kitahara, who identifies him as the culprit behind the uniform incident, and blackmails him into terrorizing the other girls in the class in the same way he dealt with her bullies. Left with few options, Kurosawa agrees and thus begins a coming-of-age story that deals with consequences, bullying, and people\'s ability to change.', '3.jpg', '3.jpg', 'Manga', 31, 4, 'Finished', '2007-09-00', '2008-03-00', 'Drama, Psychological, School'),
(4, 'Akame ga Kill!', 'The cruel Minister Honest exploits the ignorance of a new young emperor and dishonestly rules the country from the shadows with distorted morals and no regard for human life. As a result of this, an epidemic of crime and corruption has spread throughout the country\'s capital, and a state of society occurs where the privileged have absolute dominion over the less.<br><br>\r\n\r\nHowever, there exists an organization to combat this abuse of power: Night Raid, a secret division of the opposing Revolutionary Army. It is composed of a small team of ruthless assassins who assassinate all those who partake in or turn a blind eye to the Empire\'s outrageous wrongdoings.<br><br>\r\n\r\nTatsumi is a naive, sword-wielding youth on a journey to save his impoverished village. Soon, he witnesses the bloody horrors and cruelty of the capital firsthand. Overcome with hatred, Tatsumi is swayed by Night Raid\'s profound cause and decides to join them, embarking on a painful and perilous mission to exact revenge on Minister Honest. Tatsumi gains many invaluable experiences as he unravels the ethics of conflicting ideologies, life and death, while working toward the restoration of a humane world.', '4.jpg', '4.jpg', 'Manga', 80, 15, 'Finished', '2010-04-22', '2016-12-22', 'Action, Drama, Fantasy, Horror, Shounen'),
(5, 'Berserk', 'Guts, a former mercenary now known as the \"Black Swordsman,\" is out for revenge. After a tumultuous childhood, he finally finds someone he respects and believes he can trust, only to have everything fall apart when this person takes everything important to Guts for the purpose of fulfilling his own desires. Now marked for death, Guts becomes condemned to a fate in which he is relentlessly pursued by demonic beings.<br><br>\r\n\r\nSetting out on a dreadful mission riddled with misfortune, Guts, armed with a massive sword and monstrous strength, will let nothing stop him, not even death itself, until he is finally able to take the head of the one who stripped him—and his loved one—of their humanity.', '5.jpg', '5.jpg', 'Manga', NULL, NULL, 'Publishing', '1989-08-25', NULL, 'Action, Adventure, Demons, Drama, Fantasy, Horror, Supernatural, Military, Psychological, Seinen'),
(6, 'Yahari Ore no Seishun Love Comedy wa Machigatteiru.', 'Hachiman Hikigaya, a student of Soubu High School, is a cynical loner due to his traumatic past experiences in his social life. This has led him to develop a set of \"dead fish eyes\" and a twisted personality akin to that of a petty criminal. Believing that the concept of youth is a lie made up by young people facing their failures in denial, he writes an essay criticizing this exact mindset of the youth. Irritated by the submission, his homeroom teacher, Shizuka Hiratsuka, forces him to join the Volunteer Service—a club that helps students solve their problems in life, hoping that helping others will change his personality.<br><br>\r\n\r\nHowever, Yukino Yukinoshita, the most beautiful girl in the school, is surprisingly the only club member and loner, though colder and smarter than Hikigaya. The club soon expands when Yui Yuigahama joins them after being helped with her situation, and they begin to take on more requests.<br><br>\r\n\r\nWith his status quo as a recluse, Hikigaya tries to solve problems in his own way, but his methods may prove to be a double-edged sword.', '6.jpg', '6', 'Novel', NULL, NULL, 'Publishing', '2011-03-23', NULL, 'Comedy, Romance, School'),
(7, 'Komi-san wa, Comyushou desu.', 'It is Shouko Komi\'s first day at the prestigious Itan Private High School, and she has already reached the status of the school\'s Madonna. With long black hair and a tall, graceful appearance, she captures the attention of whoever crosses her path. However, there is just one problem—despite her popularity, Shouko is terrible at communicating with others.<br><br>\r\n\r\nHitohito Tadano is your average high school boy. With his life motto of \"read the situation and make sure to stay out of trouble,\" he quickly finds out that sitting next to Shouko has made him the enemy of everyone in his class! One day, knocked out by accident, Hitohito later wakes up to the sound of Shouko\'s \"meow.\" He lies that he did not hear anything, causing Shouko to run away. But before she can escape, Hitohito guesses that Shouko is not able to converse with other people easily—in fact, she has never been able to make a single friend. Hitohito resolves to help Shouko with her goal of making a hundred friends so that she can overcome her communication disorder.', '7.jpg', '7.jpg', 'Manga', NULL, NULL, 'Publishing', '2016-05-18', NULL, 'Comedy, School, Shounen'),
(8, 'Oyasumi Punpun', 'Punpun Onodera is a normal 11-year-old boy living in Japan. Hopelessly idealistic and romantic, Punpun begins to see his life take a subtle—yet startling—turn to the adult when he meets the new girl in his class, Aiko Tanaka. It is then that the quiet boy learns just how fickle maintaining a relationship can be, and the surmounting difficulties of transitioning from a naïve childhood into a complicated adulthood. When his father assaults his mother one night, Punpun realizes another thing: those whom he admired were not as impressive as he once thought.<br><br>\r\n\r\nAs his problems increase, Punpun\'s once shy demeanor turns into voluntary reclusiveness. Instead of curing him of his problems and conflicting emotions, this only intensifies them, sending him down the dark path of maturity in this grim coming-of-age saga.', '8.jpg', '8.jpg', 'Manga', 147, 13, 'Finished', '2007-03-15', '2013-11-02', 'Drama, Slice of Life, Psychological, Seinen'),
(9, 'Shinmai Maou no Testament', '\"Hey, you said you wanted a little sister, right?\" First-year high school student Toujou Basara was suddenly questioned by his father and panicked. Furthermore, the eccentric father said that he would remarry. He then left for abroad after bringing Basara two beautiful adoptive sisters. But the true forms of Mio and Maria are actually the rookie Demon Lord and a succubus!? Basara was almost celebrated a master-servant contract with Mio, but a \"reversed\" contract was formed by mistake, and Basara is now the master!? Moreover, Basara is being hit by ecchi situations one after another due to the contract, but Mio\'s life is being pursued by other demon tribes and hero tribes!! The strongest contractor\'s desire-filled action drama begins!', '9.jpg', '9.jpg', 'Novel', 58, 12, 'Finished', '2012-09-29', '2018-04-01', 'Action, Ecchi, Fantasy, Romance, Harem, Supernatural'),
(10, 'Shonan Junai Gumi!', 'Ekichi Onizuka and Ryuji Danma are members of the infamous Oni Baku biker gang. When they\'re not riding around, they can be found at school, trying to pick up young women. This is the story of the young Onizuka, who would later become Japan\'s greatest teacher.', '10.jpg', '10.jpg', 'Manga', 267, 31, 'Finished', '1990-09-26', '1996-09-18', 'Action, Comedy, Drama, Romance, School, Shounen'),
(11, 'Monogatari Series: First Season', NULL, '11.jpg', NULL, 'Novel', NULL, NULL, 'Finished', NULL, NULL, NULL),
(12, 'Yotsuba to!', NULL, '12.jpg', NULL, 'Manga', NULL, NULL, 'Finished', NULL, NULL, NULL),
(13, 'Haikyuu!!', NULL, '13.jpg', NULL, 'Manga', NULL, NULL, 'Finished', NULL, NULL, NULL),
(14, 'Death Note', NULL, '14.jpg', NULL, 'Manga', NULL, NULL, 'Finished', NULL, NULL, NULL),

-- Table structure for table `manga_characters`
DROP TABLE IF EXISTS `manga_characters`;
CREATE TABLE IF NOT EXISTS `manga_characters` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `mangaID` int(11) NOT NULL,
  `characterID` int(11) NOT NULL,
  `characterRole` varchar(50),
  PRIMARY KEY (`ID`),
  KEY `mangaID` (`mangaID`),
  KEY `characterID` (`characterID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- Dumping data for table `manga_characters`
INSERT INTO `manga_characters` (`ID`, `mangaID`, `characterID`, `characterRole`) VALUES
(1, 1, 19, 'Main'),
(2, 1, 20, 'Main'),
(3, 1, 21, 'Main'),
(4, 1, 22, 'Main'),
(5, 1, 23, 'Main'),
(6, 1, 24, 'Main'),
(7, 2, 25, 'Main'),
(8, 2, 26, 'Main'),
(9, 2, 27, 'Main'),
(10, 2, 28, 'Supporting'),
(11, 2, 29, 'Supporting'),
(12, 2, 30, 'Supporting');

-- Table structure for table `manga_favorites`
DROP TABLE IF EXISTS `manga_favorites`;
CREATE TABLE IF NOT EXISTS `manga_favorites` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `mangaID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `mangaID` (`mangaID`),
  KEY `userID` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Table structure for table `manga_users`
DROP TABLE IF EXISTS `manga_users`;
CREATE TABLE IF NOT EXISTS `manga_users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `mangaID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `userStatus` int(1) NOT NULL DEFAULT '1',
  `userScore` int(2) DEFAULT NULL,
  `userChapters` int(4) NOT NULL DEFAULT '0',
  `userVolumes` int(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `manga` (`mangaID`),
  KEY `users` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Table structure for table `users`
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(255) NOT NULL,
  `userEmail` varchar(255) NOT NULL,
  `userPassword` varchar(255) NOT NULL,
  `userPermissions` int(1) DEFAULT '0',
  `userAvatar` varchar(255),
  `userBanner` varchar(255),
  `userBannerList` varchar(255),
  `userAbout` text,
  `userGender` int(1) NOT NULL DEFAULT '0',
  `userBirthday` date,
  `userLocalization` varchar(255),
  `userDate` date NOT NULL,
  `userOnlineStatus` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Table structure for table `users_comments`
DROP TABLE IF EXISTS `users_comments`;
CREATE TABLE IF NOT EXISTS `users_comments` (
  `commentID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `userIDProfile` int(11) NOT NULL,
  `userComment` text NOT NULL,
  `commentDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`commentID`),
  KEY `userID` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Table structure for table `admins`
DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `adminID` int(11) NOT NULL AUTO_INCREMENT,
  `adminName` varchar(255) NOT NULL,
  `adminEmail` varchar(255) NOT NULL,
  `adminPassword` varchar(255) NOT NULL,
  PRIMARY KEY (`adminID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table `admins`
-- The password '12345' is hashed using password_hash function
INSERT INTO `admins` (`adminID`, `adminName`, `adminEmail`, `adminPassword`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$e0MYzXyjpJS2Pd0RVvHwHeFX5e4x3x9zZk5e6w5e6w5e6w5e6w5e6');

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;