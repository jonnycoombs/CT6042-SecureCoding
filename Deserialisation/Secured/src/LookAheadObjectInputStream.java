/**
 * Created on 05/12/2020
 * @author Jonathan Coombs s1704616@glos.ac.uk
 * Based on work by Pierre Ernst, IBM
 */

import java.io.*;
import java.util.logging.Level;


public class LookAheadObjectInputStream extends ObjectInputStream {

    public LookAheadObjectInputStream(InputStream inputStream)
            throws IOException {
        super(inputStream);
    }
    @Override
    protected Class<?> resolveClass(ObjectStreamClass desc) throws IOException,
            ClassNotFoundException {
        Log logging = new Log("Secure_Serialisation.txt");
        logging.logger.setLevel(Level.INFO);

        logging.logger.info("Deserializing");
        if (!desc.getName().equals(userModel.class.getName())) {
            throw new InvalidClassException(
                    "Unauthorized deserialization attempt", desc.getName());

        }
        logging.logger.severe("Unauthorized deserialization attempt" + desc.getName());
        return super.resolveClass(desc);
    }
}