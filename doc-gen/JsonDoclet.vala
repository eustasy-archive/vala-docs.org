namespace DocGen {
    private class PackageVisitor : Valadoc.Api.Visitor {
        public unowned Xml.TextWriter builder { private get; construct; }

        public PackageVisitor (Xml.TextWriter builder) {
            Object (builder: builder);
        }

        public override void visit_tree (Valadoc.Api.Tree tree) {
            assert_not_reached ();
        }

        public override void visit_package (Valadoc.Api.Package package) {
            assert_not_reached ();
        }

        public override void visit_namespace (Valadoc.Api.Namespace namespace) {
            if (namespace.name == null) {
                namespace.accept_all_children (this);

                return;
            }

            write_container_element ("namespace", namespace);

            namespace.accept_all_children (this);

            check_error_code (builder.end_element ());
        }

        public override void visit_interface (Valadoc.Api.Interface interface) {
            write_container_element ("interface", interface);

            interface.accept_all_children (this);

            check_error_code (builder.end_element ());
        }

        public override void visit_class (Valadoc.Api.Class class) {
            write_container_element ("class", class);

            class.accept_all_children (this);

            check_error_code (builder.end_element ());
        }

        public override void visit_struct (Valadoc.Api.Struct item) {
            item.accept_all_children (this);
        }

        public override void visit_error_domain (Valadoc.Api.ErrorDomain item) {
            item.accept_all_children (this);
        }

        public override void visit_enum (Valadoc.Api.Enum item) {
            item.accept_all_children (this);
        }

        public override void visit_property (Valadoc.Api.Property item) {
        }

        public override void visit_constant (Valadoc.Api.Constant item) {
        }

        public override void visit_field (Valadoc.Api.Field item) {
        }

        public override void visit_error_code (Valadoc.Api.ErrorCode item) {
        }

        public override void visit_enum_value (Valadoc.Api.EnumValue item) {
        }

        public override void visit_delegate (Valadoc.Api.Delegate item) {
        }

        public override void visit_signal (Valadoc.Api.Signal item) {
        }

        public override void visit_method (Valadoc.Api.Method item) {
        }

        private void write_container_element (string type, Valadoc.Api.Symbol symbol) {
            check_error_code (builder.start_element (type));
            check_error_code (builder.write_attribute ("name", symbol.name));

            check_error_code (builder.write_attribute ("deprecated", symbol.is_deprecated.to_string ()));

            string visibility = "";
            if (symbol.is_internal)
                visibility = "internal";
            else if (symbol.is_private)
                visibility = "private";
            else if (symbol.is_protected)
                visibility = "protected";
            else if (symbol.is_public)
                visibility = "public";
            check_error_code (builder.write_attribute ("visibility", visibility));
        }
    }

    public class JsonDoclet : Valadoc.Doclet, Valadoc.Api.Visitor {
        private static const string OUTPUT_DIR = "docs";
        private static const bool USE_COMPRESSION = false;

        private Valadoc.Settings settings;

        public void process (Valadoc.Settings settings, Valadoc.Api.Tree tree, Valadoc.ErrorReporter reporter) {
            this.settings = settings;

            DirUtils.create_with_parents (OUTPUT_DIR, 0755);

            tree.accept (this);
        }

        public override void visit_tree (Valadoc.Api.Tree tree) {
            tree.accept_children (this);
        }

        public override void visit_package (Valadoc.Api.Package package) {
            if (!package.is_browsable (settings)) {
                return;
            }

            Xml.TextWriter builder = new Xml.TextWriter.filename ("%s/%s.xml".printf (OUTPUT_DIR, package.name), USE_COMPRESSION);
            check_error_code (builder.start_document ("1.0", "utf-8"));
            builder.set_indent (true);

            check_error_code (builder.start_element ("package"));
            check_error_code (builder.write_attribute ("name", package.name));

            PackageVisitor package_visitor = new PackageVisitor (builder);

            package.accept_all_children (package_visitor);

            check_error_code (builder.end_element ());
            check_error_code (builder.end_document ());
        }
    }

    private void check_error_code (int error_code) {
        if (error_code < 0) {
            error ("Writing to xml file failed with error code #%i", error_code);
        }
    }
}

public Type register_plugin (Valadoc.ModuleLoader loader) {
    return typeof (DocGen.JsonDoclet);
}
