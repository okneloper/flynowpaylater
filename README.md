# Installation

This was built with php 7.4 and composer.lock included. Feel free to remove composer.lock
and try run the script on another PHP version, later version will most likely work, but 
wasn't tested.

```shell
composer install
```

# Run the script

Run the script as defined in the requirements, e.g.: 

```shell
php script.php  --input=tests/data/valid_input.txt -f most-repeating -L -P -S
```

# Some notes on the results

The output of your example app for `least-repeating` format with my input 
(see `tests/data/valid_input.txt`) 
doesn't seem to be correct, the `=` is repeated 19 times. My code returns `#` which is 
repeated 12 times, there's also a less-repeating (than the `=`) `%` - 14 times. 
Unless these are punctuation marks (which I haven't found any evidence for) there seems to 
be a bug in your app. Or it's my lack of understanding of the requirements. 

Either way, it would help if there were clearly defined sets of chars for each set 
(letters, punctuation, symbols). 

So my output doesn't match yours for the `tests/data/valid_input.txt` input, and I didn't 
fix it, but set the expected output to be `First non-repeating symbol: #`.

Also, I've included & in punctuation marks although research suggests it isn't a 
punctuation mark in English language. Just because your example returns `&` in the 
punctuation output.

# Performance

There are ways to make the code perform faster, but this will require sacrificing
some of the OO design decisions. With input under of size of under 1KB this is 
not required.

Memory consumption doesn't change much with bigger files. Here's the result for a 
1MB input:
```shell
$ php script.php  --input=tests/data/big_input.txt -f most-repeating -L -P -S
File: tests/data/big_input.txt
First most-repeating letter: x
First most-repeating punctuation: &
First most-repeating symbol: |
Execution length in seconds: 3.53844
Memory consumption: 4.244MB
```

And 10MB input: 

```shell
$ php script.php  --input=tests/data/big_input.txt -f non-repeating -L -P -S
File: tests/data/big_input.txt
First non-repeating letter: None
First non-repeating punctuation: None
First non-repeating symbol: None
Execution length in seconds: 35.30189
Memory consumption: 4.244MB
```
