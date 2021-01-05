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
    //This functions checks the input is correctly formatted and if not explains how to correctly use the program
    if(argc != 2) {
        printf("usage: %s <file>\n", argv[0]);
        exit(1);
    }
//The below line was moved from the bottom so that the file is opened before it is checked if it is owned by root
// This prevents the ability for a time-of-check to time-of-use race condtion to occur
    fd = open(argv[1], O_RDONLY);

    // This function checks if the above fd variable contains a 1 (success) showing the file can open if not then it prints an error
    if(fd <= 0)
    {
        fprintf(stderr, "Could not open inputted file %s\n", argv[1]);
        exit(1);
    }
//Getting information about the file after it has already been read into memory
    struct stat stat_data;
    if (fstat(fd, &stat_data) < 0) {
        fprintf(stderr, "Failed to get file information %s: %s\n", argv[1], strerror(errno));
        exit(1);
    }
    // If the file is owned by root it will print that and exit the program.
    if(stat_data.st_uid == 0)
    {
        fprintf(stderr, "The File %s is owned by root user\n", argv[1]);
        exit(1);
    }

    //This function writes the read file into the bufer and then prints it until size = 0
    do {
        size = read(fd, buf, 512);
        write(1, buf, size);
    } while(size>0);

}
