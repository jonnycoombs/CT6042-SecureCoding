/**
 * Created on 03/12/2020
 * @author Jonathan Coombs s1704616@glos.ac.uk
 */

import java.io.File;
import java.io.IOException;
import java.util.logging.FileHandler;
import java.util.logging.Logger;
import java.util.logging.SimpleFormatter;

public class Log {

    public Logger logger;
    FileHandler fileHandler;

    public Log(String file_name) throws SecurityException, IOException {

//        This if checks if the logging file already exist, if not it creates one
        File file = new File(file_name);
        if(!file.exists()){
            file.createNewFile();
        }

        // Initialising the file handler with the file specified and setting it to append that file with new logs
        fileHandler = new FileHandler(file_name, true);
        logger = Logger.getLogger("serialisation");
        logger.addHandler(fileHandler);
        SimpleFormatter formatter = new SimpleFormatter();
        fileHandler.setFormatter(formatter);

        fileHandler.close();

    }


}
