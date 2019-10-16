# Kelompok EA

Dindra Setyadharma (053118400000xx)
Muhammad Ilya Asha Soegondo (05311840000010)
Milenia (053118400000xx)

## Installation

Install Database (Default is "test")
1. Accounts Table

```sql
CREATE TABLE IF NOT EXISTS `accounts` (
    `id` int(11) NOT NULL AUTO_INCREMENT, 
    `username` varchar(50) NOT NULL, 
    `password` varchar(255) NOT NULL, 
    `email` varchar(100) NOT NULL,
    `fullname` varchar(255) NOT NULL,
    `activation_code` varchar(50) DEFAULT '',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
```

2. Images Table

```sql
CREATE TABLE IF NOT EXISTS `images` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`title` text NOT NULL,
  	`description` text NOT NULL,
  	`path` text NOT NULL,
  	`uploaded_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
```

## Usage

Serve with XAMPP or use LAMP stack

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)