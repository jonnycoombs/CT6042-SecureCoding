#include <string.h>
#include <stdio.h>
#include <sys/types.h>
#include <sys/stat.h>
#include <fcntl.h>
#include <errno.h>

// Race Condition (TOCTUO)

int main(int argc, char* argv[]) {
    //Declaring variables
    int fd;
    int size = 0;
    char buf[512];
//This functions checks the input is correctly formatted and if not explains how to correctly
    if(argc != 2) {
        printf("usage: %s <file>\n", argv[0]);
        exit(1);
    }
//This is the begninng of the exploit as it will check here for info about the file that was given to it 
    struct stat stat_data;
// Handling the error if getting the files info failed
    if (stat(argv[1], &stat_data) < 0) {
        fprintf(stderr, "Failed to get file information %s: %s\n", argv[1], strerror(errno));
        exit(1);
    }
//Here this function checks using the data gathered above if the file is root or not
    if(stat_data.st_uid == 0)
    	
 // If the file is owned by root it will print that and exit the program.
    {
        fprintf(stderr, "This File %s is owned by root user\n", argv[1]);
        exit(1);
    }
//Opens the file in readonly mode
    fd = open(argv[1], O_RDONLY);
    // This function checks if the above fd variable contains a 1 showing the file can open if not then it prints an error
    if(fd <= 0)
    {
        fprintf(stderr, "Could not open inputted file %s\n", argv[1]);
        exit(1);
    }
//This function writes the read file into the bufer and then prints it until size = 0
    do {
        size = read(fd, buf, 512);
        write(1, buf, size);
    } while(size>0);

}
